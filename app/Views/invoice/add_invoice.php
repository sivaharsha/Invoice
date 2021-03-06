<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style>
        .sub_total {
            display: flex;
        }

        select {
            width: 100%;
        }
    </style>





</head>

<body>
    <div class="container">
        <div class="row mt-5 text-center">
            <div class="col-sm-2 ">
                Name
            </div>
            <div class="col-sm-2">
                Quantity
            </div>
            <div class="col-sm-2">
                Price
            </div>
            <div class="col-sm-2">
                Tax
            </div>
            <div class="col-sm-2">
                Total
            </div>
            <div class="col-sm-2 form-group">
                <button id='add'>Add new</button>
            </div>
        </div>

        <div class="block text-center">
            <form action='invoice/add' id='form' method="post">
                <!-- <form id='form' method="post"> -->
                <div class="row mt-5 boxes" id='box_1''>
                <div class="col-sm-2 form-group">
                    <input type="text" name="name[]" class="form-control" id="">
                </div>
                <div class="col-sm-2 form-group">
                    <input type="number" class="form-control quantity" name="quantity[]" id="">
                </div>
                <div class="col-sm-2 form-group">
                    <input type="number" class="form-control price" name="price[]" id="">
                </div>
                <div class="col-sm-2 form-group">
                    <select  id="tax" class="tax" name="tax[]">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
            </div>
            <div class="col-sm-2 form-group">
                <input type="text" class="form-control line_total" disabled>
            </div>
            <div class="col-sm-2 form-group" style=' display: none;'>
                    <input type="text" class="form-control line_total_wot" disabled>
                </div>
            </form>
        </div>


        <hr>

        <div class="row mt-5">
            <div class="col-sm-5 offset-sm-6 form-group sub_total">
                <div class="col-sm-5">
                    <label>Sub total without tax </label>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control total_wot" disabled>
                </div>
            </div>
        </div>
        <div class=' row'>
            <div class="col-sm-5 offset-sm-6 form-group sub_total">
                <div class="col-sm-5">
                    <label>Sub total with tax</label>
                </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control total_wt" disabled>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class="col-sm-6 offset-sm-6">
                <input type="submit" form="form" value="Generate Invoice">
            </div>
        </div>

    </div>





    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {

        $('#add').click(function () {
            $('.boxes:last').after(`
            <div class="row mt-3 boxes">
                <div class="col-sm-2 form-group">
                    <input type="text" class="form-control"  name="name[]" id="" >
                </div>
                <div class="col-sm-2 form-group">
                    <input type="number" class="form-control quantity" name="quantity[]" id="" >
                </div>
                <div class="col-sm-2 form-group">
                    <input type="number" class="form-control price" name="price[]" id="" >
                </div>
                <div class="col-sm-2 form-group">
                    <select class='tax' id="tax" name="tax[]">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                </div>
                <div class="col-sm-2 form-group">
                    <input type="text" class="form-control line_total"
                        disabled>
                </div>
                <div class="col-sm-2 form-group" style='display: none;'>
                <input type="text" class="form-control line_total_wot" disabled >
                </div>
                <span class="remove">Remove</span>
            </div>
            `);

            $(".boxes").each(function (i) {
                $(this).attr('id', 'box_' + i);
            });

        });
     





            $('.block').on('click', '.remove', function () {
                $(this).parent().remove();
                findSubTotal();
            });


            $('.block').on('change', '.price', calTotal)
                .on('change', '.quantity', calTotal)
                .on('change', '.tax', calTotal);

            function calTotal() {
                var $row = $(this).closest('.boxes'),
                    price = $row.find('.price').val(),
                    quantity = $row.find('.quantity').val(),
                    tax = $row.find('.tax').val();
                total = (price * quantity);
                $row.find('.line_total_wot').val(total)
                total = total + (total * tax / 100)
                $row.find('.line_total').val(total)
                findSubTotal()
            }

            function findSubTotal() {
                var sum = sum_wot = 0;
                $(".line_total").each(function () {
                    if (!isNaN(this.value) && this.value.length != 0) {
                        console.log("====", this.value)
                        sum += parseFloat(this.value);
                    }
                });
                $(".line_total_wot").each(function () {
                    if (!isNaN(this.value) && this.value.length != 0) {

                        sum_wot += parseFloat(this.value);
                    }
                });

                $(".total_wot").val(sum_wot.toFixed(2));
                $(".total_wt").val(sum.toFixed(2));

            }

           
        });



    </script>




</body>

</html>