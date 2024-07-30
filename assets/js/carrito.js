function agregarAlCarrito(productId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "database/add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                alert(response.message);
                actualizarContadorCarrito();
            } else {
                alert("Error: " + response.message);
            }
        }
    };
    xhr.send("product_id=" + productId);
}

function actualizarContadorCarrito() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "database/get_cart_count.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("cart-counter").innerText = xhr.responseText;
        }
    };
    xhr.send();
}
