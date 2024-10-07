<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        
        main {
            padding: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table, th, td {
            border: 1px solid #ddd;
        }
        
        th, td {
            padding: 8px;
            text-align: center;
        }
        
        th {
            background-color: #f4f4f4;
        }
        
        #cartSummary {
            margin-top: 20px;
        }
        
        #totalAmount {
            font-size: 1.2em;
        }
        
        button {
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Shopping Cart</h1>
    </header>
    <main>
        <table id="cartTable">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cartBody">
                <!-- Cart items will be dynamically added here -->
            </tbody>
        </table>
        <div id="cartSummary">
            <h2>Cart Summary</h2>
            <p id="totalAmount">Total Amount: $0.00</p>
            <button id="checkoutBtn">Proceed to Checkout</button>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartItems = [
                { name: 'Medicine A', price: 10.00, quantity: 2 },
                { name: 'Medicine B', price: 5.00, quantity: 1 }
            ];

            const cartBody = document.getElementById('cartBody');
            const totalAmountElem = document.getElementById('totalAmount');
            
            function updateCart() {
                let total = 0;
                cartBody.innerHTML = '';
                
                cartItems.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${item.name}</td>
                        <td>$${item.price.toFixed(2)}</td>
                        <td>${item.quantity}</td>
                        <td>$${itemTotal.toFixed(2)}</td>
                        <td><button onclick="removeItem(${index})">Remove</button></td>
                    `;
                    cartBody.appendChild(row);
                });
                
                totalAmountElem.textContent = Total Amount: $${total.toFixed(2)};
            }

            window.removeItem = function(index) {
                cartItems.splice(index, 1);
                updateCart();
            };

            updateCart();
        });
    </script>
</body>
</html>