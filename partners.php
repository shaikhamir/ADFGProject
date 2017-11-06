<!DOCTYPE html>
<html lang="en">

<head>
    <title>Partners</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!--[if lt IE 9]> <script src=https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js></script> <script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script> <![endif]-->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <main class="container partners-table">
        <div class="col-xs-12 logo-section clearfix">
            <a href="#" class="pull-left">
                <img src="images/png/stik-2.png" />
            </a>
            <a href="#" class="pull-right">
                <img src="images/png/swoo-logo.png" />
            </a>
        </div>
        <h2 class="page-title">
            Publish Content System
        </h2>
        <div class="table-controls clearfix">
            <div class="exportDownload-controls">
                <button type="button" class="btn btn-theme btn-print"><i class="btn-icon"></i> Print</button>
                <button type="button" class="btn btn-theme btn-downloadFile"><i class="btn-icon"></i> Download File</button>
            </div>
            <div class="filter-controls">
                <input type="text" name="from" class="form-control theme-control" placeholder="from" />
                <input type="text" name="to" class="form-control theme-control" placeholder="to" />
                <button type="button" class="btn btn-theme btn-filter"><i class="btn-icon"></i>Filter</button>
            </div>
        </div>
        <div class="table-grid">
            <table id="partners-datatable" class="table">
                <thead>
                    <tr>
                        <th class="no-sort">Count</th>
                        <th class="no-sort">Name</th>
                        <th>Type</th>
                        <th>Unlock Count</th>
                        <th>View Count</th>
                        <th>Frequency</th>
                        <th>Completed View</th>
                        <th>Completion Rate</th>
                        <th>Earnings</th>
                    </tr>
                </thead>
                <tbody class="tableBody">

                </tbody>
                <tfoot>
                    <tr id="average-row">
                        <td>Average</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>8</td>
                        <td></td>
                        <td>45%</td>
                        <td></td>
                    </tr>
                    <tr id="total-row">
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td>50</td>
                        <td>300</td>
                        <td></td>
                        <td>1400</td>
                        <td></td>
                        <td>250</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
    <div class="alert-box">
        <div class="alert authAlert alert-danger alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Alert! </strong><span></span>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/roundNumber.js"></script>
    <script>
        var authToken = "<?php echo $_GET['token']; ?>";
        $.ajax({
            url: "https://abjadiyat-dev.ap-southeast-1.elasticbeanstalk.com/publisher/reports",
            type: "GET",
            dataType: 'json',
            beforeSend: function(response) {
                response.setRequestHeader("Authorisation", authToken);
            },
            data: authToken,
            success: function(dataResponse) {
                if (dataResponse._statusCode === 200) {
                    initTableGrid(dataResponse._entity);
                } else {
                    $(".alert-box").fadeIn().find("span").html("Token Invalid");
                }
            }
        });

        var typeValue = function(data) {
            if (data === 1) {
                return "ABJ";
            } else if (data === 2) {
                return "Video";
            } else if (data === 3) {
                return "E-Book";
            } else if (data === 4) {
                return "Game";
            } else if (data === 5) {
                return "Video";
            } else if (data === 6) {
                return "E-Book";
            } else if (data === 7) {
                return "7";
            } else if (data === 8) {
                return "PRG";
            } else if (data === 9) {
                return "PRA";
            }
        }

        var initTableGrid = function(data) {
            console.log(data);
            var count = 1;
            for (var i = 0; i <= data.length; i++) {
                $("#partners-datatable .tableBody").append(
                    '<tr>' +
                    '<td class="td-count">' + count + '</td>' +
                    '<td class="td-name">' + data[i].contentId + '</td>' +
                    '<td class="td-type">' + typeValue(data[i].contentType) + '</td>' +
                    '<td class="td-uCount">' + data[i].unlockCount + '</td>' +
                    '<td class="td-vCount">' + data[i].playCount + '</td>' +
                    '<td class="td-frequency">' + data[i].frequency + '</td>' +
                    '<td class="td-cView">' + data[i].completedView + '</td>' +
                    '<td class="td-cRate">' + data[i].completionRate + '%</td>' +
                    '<td class="td-earnings">$' + data[i].earnings + '</td>' +
                    '</tr>');
                count++;
            }
        }

        function disableBack() {
            window.history.forward()
        }

        window.onload = disableBack();
        window.onpageshow = function(evt) {
            if (evt.persisted) disableBack()
        }

    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>

    <script>
        /*<![CDATA[*/
        $(document).ready(function() {
            var table = $('#partners-datatable').DataTable({
                "processing": true,
                "deferRender": true,
                "dom": 'Bfrtip',
                "searching": false,
                "lengthChange": false,
                "info": false,
                "buttons": [
                    'print', 'excel'
                ],
                "order": [],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }],
                "pageLength": 15
            });

            var tableControlsW = $(".partners-table").width() - $(".dataTables_paginate").width();
            $(".table-controls").css("width", tableControlsW);

            $(".theme-control").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            });

            $(".theme-control").val("");

            $(".btn-print").on("click", function() {
                table.button('.buttons-print').trigger();
            });
            $(".btn-downloadFile").on("click", function() {
                table.button('.buttons-excel').trigger();
            });
            /*]]>*/
        });

    </script>
</body>


</html>