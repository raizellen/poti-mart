function toggleCart() {
    const cartPanel = document.getElementById('cart-panel');
    cartPanel.classList.toggle('open');

    if (cartPanel.classList.contains('open')) {
        loadCart();
    }
}

document.getElementById('cart-close').addEventListener('click', function() {
    const cartPanel = document.getElementById('cart-panel');
    cartPanel.classList.remove('open');
});

function loadCart() {
    fetch('/poti assignment 1/features/get_cart.php')
        .then(res => res.json())
        .then(data => {
            const cartItems = document.getElementById("cart-items");
            const cartCount = document.getElementById("cart-count");
            const cartTotal = document.querySelector(".cart-summary p");
            const checkoutBtn = document.getElementById("checkout-btn");

            let total = 0, count = 0;
            cartItems.innerHTML = '';

            if (data.length === 0) {
                cartItems.innerHTML = '<p>Your cart is empty.</p>';
                checkoutBtn.classList.add("disabled");
                checkoutBtn.setAttribute("disabled", true);
                cartTotal.textContent = 'Total: $0.00';
                cartCount.textContent = '0';
                return;
            }

            data.forEach(item => {
                const itemHTML = `
                    <div class="cart-items">
                        <img src="${item.image}" alt="${item.name}">
                        <div>
                            <strong>${item.name}</strong><br>
                            <small>${item.unit_quantity}</small><br>
                            $${item.price.toFixed(2)} ×
                            <form id="form-${item.product_id}" method="POST" action="/poti assignment 1/features/update_cart.php" target="hidden-frame" style="display:inline;">
                                <input type="hidden" name="product_id" value="${item.product_id}">
                                <input type="hidden" name="change" id="change-${item.product_id}" value="0">
                                <button type="button" class="quantity-btn" onclick="updateQuantity(${item.product_id}, -1)">−</button>
                                <span id="qty-${item.product_id}">${item.qty}</span>
                                <button type="button" class="quantity-btn" onclick="updateQuantity(${item.product_id}, 1)">+</button>
                            </form>
                            <br>
                            <strong>$${item.total.toFixed(2)}</strong>
                        </div>
                    </div>
                `;
                cartItems.innerHTML += itemHTML;
                total += item.total;
                count += item.qty;
            });

            cartCount.textContent = count;
            cartTotal.textContent = `Total: $${total.toFixed(2)}`;
            checkoutBtn.classList.remove("disabled");
            checkoutBtn.removeAttribute("disabled");
        })
        .catch(err => console.error('Error loading cart:', err));
}

function updateQuantity(productId, change) {
    const changeInput = document.getElementById(`change-${productId}`);
    changeInput.value = change;
    document.getElementById(`form-${productId}`).submit();
}