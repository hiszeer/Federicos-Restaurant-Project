<?php include('partials-front/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">My Cart</h1>
        <br><br>
        <center>
            <form id="cartForm" method="post" action="update-cart.php">
                <table class="content-table" id="cartTable">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Food</th>
                            <th>Price</th>
                            <th>Qty.</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT * FROM tbl_order WHERE u_id={$_SESSION['u_id']} AND status='Ordered'";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        $sn = 1;
                        $grandTotal = 0;

                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $price * $qty;
                                $grandTotal += $total;
                        ?>
                        <tr data-id="<?php echo $id; ?>">
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td class="price"><?php echo $price; ?></td>
                            <td>
                                <input type="number" class="qty" name="qty[<?php echo $id; ?>]" value="<?php echo $qty; ?>" min="1">
                            </td>
                            <td class="total"><?php echo $total; ?></td>
                            <td><button type="button" class="remove-item">Remove</button></td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' class='error'>Your cart is empty!</td></tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right;"><strong>Grand Total:</strong></td>
                            <td colspan="2" id="grandTotal"><strong><?php echo $grandTotal; ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </center>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Update total when qty changes
    $('.qty').on('change', function(){
        let row = $(this).closest('tr');
        let price = parseFloat(row.find('.price').text());
        let qty = parseInt($(this).val());
        let total = price * qty;
        row.find('.total').text(total.toFixed(2));

        updateGrandTotal();
        
        // Optional: AJAX update to DB
        // You could send an AJAX request here to save updated quantity
    });

    // Remove item
    $('.remove-item').click(function(){
        let row = $(this).closest('tr');
        let orderId = row.data('id');

        // Optional: Remove from DB via AJAX
        $.post('remove-item.php', { id: orderId }, function(response){
            if(response == 'success'){
                row.remove();
                updateGrandTotal();
            } else {
                alert('Failed to remove item.');
            }
        });
    });

    // Calculate grand total
    function updateGrandTotal(){
        let grandTotal = 0;
        $('#cartTable .total').each(function(){
            grandTotal += parseFloat($(this).text());
        });
        $('#grandTotal').text(grandTotal.toFixed(2));
    }
});
</script>

<?php include('partials-front/footer.php'); ?>
