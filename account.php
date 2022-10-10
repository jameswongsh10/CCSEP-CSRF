<?php
require_once('common.php');
if (!isLoggedIn()) {
    header('Location: /index.html');
}
getCSRFToken("asdasdadasdasd");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CCSEP-CSRF</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-1.12.4.min.js"></script>
</head>
<body>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav pull-right">
                <li>
                    <button id="reset" class="btn btn-primary">Reset</button>
                </li>
            </ul>
            <h3 class="text-muted">Bank of Antarctica</h3>
        </nav>
    </div>
    <div class="jumbotron">
        <h1><strong>Balance:</strong> $<span id="balance"><?= $_SESSION['balance'] ?></span></h1>
    </div>
    <div class="row">
        <div class="col-md-8">
            <h3>Transfers</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($_SESSION['transfers'] as $transfer) {
                    ?>
                    <tr>
                        <td><?= $transfer['from'] ?></td>
                        <td><?= $transfer['to'] ?></td>
                        <td><?= $transfer['amount'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <h3>Make a Transfer</h3>
            <form method="GET" action="transfer.php">
                <input type="hidden" name="token" value="<?php echo isset($_SESSION['token']) ? $_SESSION['token'] : ''; ?>">
                <div class="form-group">
                    <label for="to">To</label>
                    <input class="form-control" type="text" name="to" id="to"/>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input class="form-control" type="text" name="amount" id="amount"/>
                </div>
                <input type="submit" class="btn btn-default" value="Send"/>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_SESSION['alertMessage'])) { ?>
    <script>alert("Thanks for the money >:)")</script>
    <?php
}
unset($_SESSION['alertMessage']);
?>
</body>

<script>
    $(document).ready(function () {
        function drawPage(data) {
            $('#balance').text(data.balance);
            $('tbody>tr').remove();
            for (var i = 0; i < data.transfers.length; i++) {
                var transfer = data.transfers[i];
                var html = '<tr><td>' + transfer.from + '</td><td>' + transfer.to + '</td><td>' + transfer.amount + '</td></tr>'
                var el = $(html);
                $('tbody').append(el);
            }
        }

        $('form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                "url": "/transfer.php",
                "method": "POST",
                "dataType": "json",
                "data": {"to": $('#to')[0].value, "amount": $('#amount')[0].value},
                "success": function (data, status, xhr) {
                    drawPage(data);
                }
            });
            return false;
        });

        $('#reset').on('click', function (event) {
            event.preventDefault();
            $.ajax({
                "url": "/reset.php",
                "method": "POST",
                "dataType": "json",
                "success": function (data, status, xhr) {
                    drawPage(data);
                }
            })
            return false;
        });
    });
</script>
<script src="js/bootstrap.min.js"></script>
</html>
