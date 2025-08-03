<?php include('session.php'); ?>
<?php include('head.php'); ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('side_bar.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                </div>
                <hr/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="alert alert-success">Election Winners</h4>
                    </div>
                    <button type="button" onclick="window.print();" style="margin-right:14px;" id="print" class="pull-right btn btn-info">
                        <i class="fa fa-print"></i> Print
                    </button>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="alert alert-success">Candidate Name</th>
                                    <th class="alert alert-success">Position</th>
                                    <td style="width:200px;" class="alert alert-success">Image</td>
                                    <th class="alert alert-success">Total Votes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require 'dbcon.php';

                                // Query to fetch candidates with the highest votes for each position
                                $query = $conn->query("SELECT c.firstname, c.lastname, c.position, c.img, MAX(v.vote_count) as total_votes 
                                    FROM (SELECT candidate_id, COUNT(*) AS vote_count FROM votes GROUP BY candidate_id) v
                                    JOIN candidate c ON c.candidate_id = v.candidate_id
                                    WHERE v.vote_count = (SELECT MAX(vote_count) FROM (SELECT candidate_id, COUNT(*) AS vote_count FROM votes GROUP BY candidate_id) sub_v WHERE c.position = (SELECT position FROM candidate WHERE candidate_id = sub_v.candidate_id))
                                    GROUP BY c.position");

                                while ($fetch = $query->fetch_assoc()) {
                                    $name = $fetch['firstname'] . " " . $fetch['lastname'];
                                    $position = $fetch['position'];
                                    $img = $fetch['img'];
                                    $total_votes = $fetch['total_votes'];
                                    ?>
                                    <tr>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $position; ?></td>
                                        <td><img src="<?php echo $fetch['img']; ?>" style="width:40px; height:40px; border-radius:500px;"></td>
                                        <td style="text-align: center;"><button class="btn btn-primary" disabled><?php echo $total_votes; ?></button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <!-- Signature Section -->
                        <div class="signature-section">
                            <p>Signature of Election Officer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('script.php'); ?>

    <style>
        /* Hide the signature section on screen */
        .signature-section {
            display: none;
        }

        /* Show the signature section only in print */
        @media print {
            .signature-section {
                display: block;
                position: fixed;
                bottom: 50px;
                right: 30px;
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                border-top: 1px solid black;
                padding-top: 10px;
                width: 200px;
            }
        }
    </style>

</body>

</html>
