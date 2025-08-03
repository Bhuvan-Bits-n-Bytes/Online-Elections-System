import cv2
import pickle
import numpy as np
import os
from sklearn.neighbors import KNeighborsClassifier
from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/recognition', methods=['POST'])
def recognition():
    try:
        # Verify data files exist
        data_dir = 'data/'
        names_file = os.path.join(data_dir, 'names.pkl')
        faces_file = os.path.join(data_dir, 'faces_data.pkl')

        if not os.path.exists(names_file) or not os.path.exists(faces_file):
            return jsonify({'error': 'Training data not found. Please add face data first.'}), 404

        # Load training data
        try:
            with open(names_file, 'rb') as f:
                LABELS = pickle.load(f)
            with open(faces_file, 'rb') as f:
                FACES = pickle.load(f)
        except Exception as e:
            return jsonify({'error': f'Failed to load training data: {str(e)}'}), 500

        # Initialize and train KNN classifier
        knn = KNeighborsClassifier(n_neighbors=5)
        knn.fit(FACES, LABELS)

        # Initialize video capture
        video = cv2.VideoCapture(0)
        if not video.isOpened():
            return jsonify({'error': 'Unable to access the camera'}), 500

        facedetect = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
        
        # Configuration
        max_attempts = 100  # Maximum frames to process
        confidence_threshold = 3  # Number of consistent predictions needed
        predictions_history = []  # Store recent predictions
        
        try:
            for _ in range(max_attempts):
                ret, frame = video.read()
                if not ret:
                    continue

                gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
                faces = facedetect.detectMultiScale(gray, 1.3, 5)

                for (x, y, w, h) in faces:
                    # Process detected face
                    crop_img = frame[y:y + h, x:x + w]
                    resized_img = cv2.resize(crop_img, (50, 50)).flatten().reshape(1, -1)
                    prediction = knn.predict(resized_img)[0]
                    
                    # Add to predictions history
                    predictions_history.append(prediction)
                    
                    # Only keep recent predictions
                    if len(predictions_history) > confidence_threshold:
                        predictions_history.pop(0)
                    
                    # Check if we have consistent predictions
                    if len(predictions_history) == confidence_threshold:
                        if all(p == predictions_history[0] for p in predictions_history):
                            return jsonify({
                                'message': 'Recognition successful',
                                'label': str(prediction),
                                'confidence': 'high'
                            })

                    # Visual feedback (if running locally)
                    cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)
                    cv2.putText(frame, str(prediction), (x, y - 10),
                              cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)

                cv2.imshow("Face Recognition", frame)
                if cv2.waitKey(1) & 0xFF == ord('q'):
                    break

            return jsonify({
                'message': 'Recognition failed',
                'error': 'Could not confidently identify face after maximum attempts'
            }), 400

        except Exception as e:
            return jsonify({'error': f'Recognition failed: {str(e)}'}), 500
            
    except Exception as e:
        return jsonify({'error': f'Unexpected error: {str(e)}'}), 500
        
    finally:
        if 'video' in locals() and video.isOpened():
            video.release()
        cv2.destroyAllWindows()

if __name__ == '__main__':
    app.run(port=5000)

