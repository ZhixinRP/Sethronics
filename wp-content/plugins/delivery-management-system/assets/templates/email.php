<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div id="wrapper" style="font-family: 'Poppins', sans-serif; max-width:650px; margin: auto auto; padding: 20px; color:black;">
        <div id="logo" style="text-align:center;">
            <a href="{SITE_ADDR}" target="_blank">
                <img src="{EMAIL_LOGO}" style="margin: 15px 0 15px 0; max-height: 75px;">
            </a>
        </div>
        <div id="content" style="text-align:center; padding: 25px; border-radius: 10px; border: 3px solid #0071BC;">
            <div>
                <div id="email-title" style="font-size: 1.5rem; font-weight: 700;">{EMAIL_TITLE}</div>
                <div id="table-container" style="width: 100%; margin: 30px 0 30px 0; display: flex;">
                    <div style="width: 50%;">
                        <div style="font-size: 1.2rem; font-weight: 700; text-align: left;">Summary</div>
                        <table>
                            <tr>
                                <th style="text-align: left;">Order ID:</th>
                                <td style="padding: 0 20px; text-align: left;">{ORDER_ID}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Customer Name:</th>
                                <td style="padding: 0 20px; text-align: left;">{CUSTOMER_NAME}</td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Delivery Personnel:</th>
                                <td style="padding: 0 20px; text-align: left;">{DELIVERY_PERSONNEL}</td>
                            </tr>
                        </table>
                    </div>
                    <div style="width: 50%;">
                        <div style="font-size: 1.2rem; font-weight: 700; text-align: left;">Address</div>
                        <table>
                            <tr>
                                <td style="text-align: left;">{ADDRESS}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="text-align: center;">
                    <a class="email-btn" href="{BUTTON_LINK}" style="display: inline-block; border-radius: 10px; border: 3px solid #0071BC; color: #0071BC; padding: 15px; cursor: pointer; text-decoration: none; transition: 0.3s;">{BUTTON_TEXT}</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>