<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
    <style>
        #wrapper {
            width: 80%;
            margin: auto auto;
            padding: 20px;
        }

        #logo {
            display: flex;
            justify-content: center;
        }

        #content {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            border-radius: 10px;
            border: 3px solid #0071BC;
        }

        .table-container {
            width: 100%;
            margin: 30px 0 30px 0;
            display: flex;
        }

        .email-btn {
            display: inline-block;
            border-radius: 10px;
            border: 3px solid #0071BC;
            color: #0071BC;
            padding: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.3s;
        }

        .email-btn:hover {
            background-color: #0071BC;
            color: #FFFFFF;
        }

        .email-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
        }

        .table-title {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .column {
            flex: 50%;
        }

        img {
            margin: 15px 0 15px 0;
            max-height: 75px;
        }

        td {
            padding: 0 20px;
        }

        th,
        td {
            text-align: left;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div id="wrapper" style="font-family: 'Poppins', sans-serif;">
        <div id="logo">
            <a href="{SITE_ADDR}" target="_blank">
                <img src="{EMAIL_LOGO}" alt="logo">
            </a>
        </div>
        <div id="content">
            <div>
                <div class="email-title">{EMAIL_TITLE}</div>
                <div class="table-container">
                    <div class="column">
                        <div class="table-title">Summary</div>
                        <table>
                            <tr>
                                <th>Order ID:</th>
                                <td>4500</td>
                            </tr>
                            <tr>
                                <th>Customer Name:</th>
                                <td>zikai liu</td>
                            </tr>
                            <tr>
                                <th>Delivery Personnel:</th>
                                <td>dp1</td>
                            </tr>
                        </table>
                    </div>
                    <div class="column">
                        <div class="table-title">Address</div>
                        <table>
                            <tr>
                                <th>53 Ang Mo Kio Avenue 3
                                    Singapore 569933</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="text-align: center;">
                    <a class="email-btn" href="">{BUTTON_TEXT}</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>