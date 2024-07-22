<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Initialize the JS-SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=ATe2NFe_tPBefQr4hUJveIErA3UQtkCuFMirh6mzqmkWUKL0v6atMUQmIV1cUj85pbLBylsaEgxizpaa&currency=USD"></script>
</head>

<body>
    <div id="button-paypal-container"></div>

    <script>
        paypal.Buttons({
            stely: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: 100
                        }
                    }]
                        
                });
            },

            onApprove: function(data, actions){
                
                actions.order.capture().then(function (detalles)) {
                    
                    console.log(detalles);
                }
            },

            oncancel:function (data){
                alert("pago cancelado");
                console.log(data)
            }
        }).render('#button-paypal-container');
    </script>
</body>

</html>