
// Tạo một XMLHttpRequest
var xhr = new XMLHttpRequest();

// Thiết lập phương thức và URL để gửi yêu cầu đến server
xhr.open('GET', 'get_products.php', true);

// Thiết lập sự kiện xử lý khi request hoàn thành
xhr.onreadystatechange = function() {
    // Kiểm tra trạng thái của request
    if (xhr.readyState === XMLHttpRequest.DONE) {
        // Kiểm tra xem request có thành công không (status code 200)
        if (xhr.status === 200) {
            // Chuyển đổi dữ liệu nhận được từ server thành một mảng JavaScript
            var products = JSON.parse(xhr.responseText);
            
            // Hiển thị sản phẩm trên trang web bằng cách gọi hàm displayProducts
            displayProducts(products);
        } else {
            // Xử lý lỗi nếu có
            console.error('Error retrieving products. Status code: ' + xhr.status);
        }
    }
};

// Gửi request đến server
xhr.send();

document.addEventListener('DOMContentLoaded', function() {
    // Hiển thị giỏ hàng
    displayCart();

    // Thêm sự kiện click vào nút "Add to Cart" cho mỗi sản phẩm
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn sự kiện mặc định của nút
            const product = JSON.parse(this.dataset.product); // Lấy dữ liệu sản phẩm từ thuộc tính dataset
            addToCart(product); // Gọi hàm addToCart khi nhấn vào nút "Add to Cart"
        });
    });

    // Xử lý sự kiện khi nhấn nút Checkout
    document.getElementById('checkout-btn').addEventListener('click', function() {
        alert('Redirecting to checkout page...'); // Thay bằng hành động chuyển hướng đến trang thanh toán thực tế
    });
});

// Hàm hiển thị giỏ hàng
// Hàm hiển thị giỏ hàng
// Hàm hiển thị giỏ hàng
// Hàm hiển thị giỏ hàng
function displayCart() {
    // Lấy danh sách sản phẩm từ Local Storage
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

    // Hiển thị sản phẩm trong giỏ hàng
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';
    
    let totalPrice = 0; // Khởi tạo biến tổng giá

    cartItems.forEach(item => {
        const cartItemElement = document.createElement('div');
        cartItemElement.classList.add('cart-item');
        cartItemElement.textContent = `${item.name} - $${item.price}`;
        cartItemsContainer.appendChild(cartItemElement);

        totalPrice += parseFloat(item.price); // Cộng giá của mỗi mặt hàng vào tổng giá
    });

    // Tính tổng số sản phẩm
    const totalItems = cartItems.length;

    // Hiển thị tổng số sản phẩm và tổng giá
    document.getElementById('total-items').textContent = totalItems;
    document.getElementById('total-price').textContent = `$${totalPrice.toFixed(2)}`;
}

// Hàm để thêm sản phẩm vào giỏ hàng và chuyển hướng đến trang giỏ hàng
function addToCart(product) {
    // Lấy danh sách sản phẩm từ Local Storage
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
        
    cartItems.push({
        name: product.Name, // Đảm bảo gán tên sản phẩm
        price: product.Price // Đảm bảo gán giá sản phẩm
    });

    // Lưu danh sách giỏ hàng vào Local Storage
    localStorage.setItem('cart', JSON.stringify(cartItems));
    alert('Product added to cart successfully!');
    // Gọi lại hàm hiển thị giỏ hàng để cập nhật thông tin
    displayCart();

    // Chuyển hướng đến trang giỏ hàng
    window.location.href = 'cart.html';
}

// Hàm để xóa toàn bộ giỏ hàng
function clearCart() {
    localStorage.removeItem('cart'); // Xóa mục 'cart' khỏi localStorage
    displayCart(); // Hiển thị giỏ hàng sau khi đã xóa
}

// Gọi hàm clearCart khi cần xóa giỏ hàng, ví dụ khi nhấn vào nút "Clear Cart"
document.getElementById('clear-cart-btn').addEventListener('click', function() {
    clearCart();
});

// Hàm để hiển thị dữ liệu sản phẩm trên trang web
function displayProducts(products) {
    const productContainer = document.querySelector('.product-container');

    // Xóa nội dung cũ của productContainer trước khi thêm sản phẩm mới
    productContainer.innerHTML = '';

    // Lặp qua mảng sản phẩm và tạo thành phần HTML cho mỗi sản phẩm
    products.forEach(product => {
        // Tạo một div mới để chứa thông tin sản phẩm
        const productDiv = document.createElement('div');
        productDiv.classList.add('product');

        // Thêm thông tin sản phẩm vào productDiv
        productDiv.innerHTML = `
            <img src="data:image;base64,${product.Image}" alt="${product.Name}">
            <h2>${product.Name}</h2>
            <p>Giá: ${product.Price}</p>
            <p>${product.Description}</p>
            <button class="add-to-cart-btn">Add to Cart</button>
        `;

        // Thêm sự kiện click vào nút "Add to Cart"
        const addToCartBtn = productDiv.querySelector('.add-to-cart-btn');
        addToCartBtn.addEventListener('click', function() {
            addToCart(product); // Gọi hàm addToCart khi nhấn vào nút "Add to Cart"
        });

        // Thêm productDiv vào productContainer
        productContainer.appendChild(productDiv);
    });
}


let productContents = [];
let currentBackground = 0;

setInterval(() => {
    currentBackground = (currentBackground % 4) + 1;
    document.body.className = `background${currentBackground}`;
    document.querySelector('header').className = `background${currentBackground}`;
    
    const products = document.querySelectorAll('.product');
    products.forEach((product, index) => {
        const productContent = productContents[currentBackground - 1][index];
        //product.querySelector('image').textContent = productContent.Image
        product.querySelector('h2').textContent = productContent.Name;
        product.querySelector('.price').textContent = `Price: ${productContent.Price}`;
        product.querySelector('.description').textContent = `Description: ${productContent.Description}`;
    });
}, 5000);

