
// Tạo một XMLHttpRequest
//var xhr = new XMLHttpRequest();

// Thiết lập phương thức và URL để gửi yêu cầu đến server
//xhr.open('GET', 'get_products.php', true);

// Thiết lập sự kiện xử lý khi request hoàn thành
// xhr.onreadystatechange = function() {
//     // Kiểm tra trạng thái của request
//     if (xhr.readyState === XMLHttpRequest.DONE) {
//         // Kiểm tra xem request có thành công không (status code 200)
//         if (xhr.status === 200) {
//             // Chuyển đổi dữ liệu nhận được từ server thành một mảng JavaScript
//             var products = JSON.parse(xhr.responseText);
            
//             // Hiển thị sản phẩm trên trang web bằng cách gọi hàm displayProducts
//             displayProducts(products);
//         } else {
//             // Xử lý lỗi nếu có
//             console.error('Error retrieving products. Status code: ' + xhr.status);
//         }
//     }
// };

// Gửi request đến server
//xhr.send();

// document.addEventListener('DOMContentLoaded', function() {
//     // Hiển thị giỏ hàng
//     displayCart();

//     //click vào nút "Add to Cart" cho mỗi sản phẩm
//     const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
//     addToCartButtons.forEach(button => {
//         button.addEventListener('click', function(event) {
//             event.preventDefault(); // Ngăn chặn sự kiện mặc định của nút
//             const product = JSON.parse(this.dataset.product); // Lấy dữ liệu sản phẩm từ thuộc tính dataset
//             addToCart(product); // Gọi hàm addToCart khi nhấn vào nút "Add to Cart"
//         });
//     });

//     //Checkout
//     document.getElementById('checkout-btn').addEventListener('click', function() {
//         alert('Redirecting to checkout page...'); // Thay bằng hành động chuyển hướng đến trang thanh toán thực tế
//     });
// });

// Hàm hiển thị giỏ hàng
// function displayCart() {
//     const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
//     const cartItemsContainer = document.getElementById('cart-items');
//     cartItemsContainer.innerHTML = '';
    
//     let totalItems = 0;
//     let totalPrice = 0;

//     cartItems.forEach((item, index) => {
//         const cartItemElement = document.createElement('div');
//         cartItemElement.classList.add('cart-item');

//         const productInfo = document.createElement('span');
//         productInfo.textContent = `${item.name} - $${item.price}`;
//         cartItemElement.appendChild(productInfo);

//         const quantityInput = document.createElement('input');
//         quantityInput.type = 'number';
//         quantityInput.value = item.quantity;
//         quantityInput.min = 1;
//         quantityInput.addEventListener('input', function() {
//             const newQuantity = parseInt(this.value);
//             updateCartItemQuantity(item, newQuantity);
//             updateTotal(); 
//         });
//         cartItemElement.appendChild(quantityInput);

//         const removeButton = document.createElement('img');
//         removeButton.src = 'images/button_delete.png';
//         removeButton.alt = 'Remove';
//         removeButton.classList.add('remove-btn');
//         removeButton.dataset.index = index;
//         removeButton.addEventListener('click', function() {
//             const index = parseInt(this.dataset.index);
//             removeCartItem(index);
//             updateTotal();
//         });
//         cartItemElement.appendChild(removeButton);

//         cartItemsContainer.appendChild(cartItemElement);

//         totalItems += item.quantity;
//         totalPrice += item.price * item.quantity;
//     });

//     document.getElementById('total-items').textContent = totalItems;
//     document.getElementById('total-price').textContent = `$${totalPrice.toFixed(2)}`;
// }

// function updateCartItemQuantity(item, newQuantity) {
//     const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
//     const index = cartItems.findIndex(cartItem => cartItem.name === item.name);

//     if (index !== -1) {
//         cartItems[index].quantity = newQuantity;
//         localStorage.setItem('cart', JSON.stringify(cartItems));

//         // Cập nhật lại số lượng và tổng giá tiền trên giao diện
//         const totalPriceElement = document.getElementById('total-price');
//         const totalItemsElement = document.getElementById('total-items');

//         // Cập nhật giá sản phẩm và tổng giá tiền
//         const totalPrice = cartItems.reduce((total, cartItem) => {
//             return total + cartItem.price * cartItem.quantity;
//         }, 0);

//         totalItemsElement.textContent = cartItems.reduce((total, cartItem) => {
//             return total + cartItem.quantity;
//         }, 0);
        
//         totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
//     }
// }


// function updateCartItemsInLocalStorage() {
//     const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
//     localStorage.setItem('cart', JSON.stringify(cartItems));
// }

// Hàm cập nhật tổng số sản phẩm và tổng giá
// function updateTotal() {
//     const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
//     let totalItems = 0;
//     let totalPrice = 0;
//     cartItems.forEach(item => {
//         totalItems += item.quantity;
//         totalPrice += item.price * item.quantity;
//     });
//     document.getElementById('total-items').textContent = totalItems;
//     document.getElementById('total-price').textContent = `$${totalPrice.toFixed(2)}`;
// }

// Hàm để thêm sản phẩm vào giỏ hàng và chuyển hướng đến trang giỏ hàng
// function addToCart(product) {
//     const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

//     // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
//     const existingItemIndex = cartItems.findIndex(item => item.name === product.Name);

//     if (existingItemIndex !== -1) {
//         // Nếu sản phẩm đã tồn tại trong giỏ hàng, chỉ cập nhật số lượng
//         cartItems[existingItemIndex].quantity++;
//     } else {
//         // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới vào
//         cartItems.push({
//             name: product.Name,
//             price: product.Price,
//             quantity: 1 // Khởi tạo số lượng là 1
//         });
//     }

//     // Lưu danh sách giỏ hàng mới vào Local Storage
//     localStorage.setItem('cart', JSON.stringify(cartItems));

//     // Hiển thị thông báo thêm sản phẩm thành công
//     alert('Product added to cart successfully!');

//     // Gọi lại hàm hiển thị giỏ hàng để cập nhật thông tin
//     displayCart();

//     // Chuyển hướng đến trang giỏ hàng
//     window.location.href = 'cart.html';
// }

// Hàm để xóa toàn bộ giỏ hàng
// function clearCart() {
//     localStorage.removeItem('cart'); // Xóa mục 'cart' khỏi localStorage
//     displayCart(); // Hiển thị giỏ hàng sau khi đã xóa
// }

// Gọi hàm clearCart khi cần xóa giỏ hàng, ví dụ khi nhấn vào nút "Clear Cart"
// document.getElementById('clear-cart-btn').addEventListener('click', function() {
//     clearCart();
// });

// Hàm để xóa sản phẩm khỏi giỏ hàng
// function removeCartItem(index) {
//         let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    
//         // Kiểm tra xem chỉ mục có hợp lệ không
//         if (Number.isInteger(index) && index >= 0 && index < cartItems.length) {
//             // Xóa sản phẩm khỏi danh sách
//             cartItems.splice(index, 1);
    
//             // Cập nhật lại danh sách giỏ hàng vào Local Storage
//             localStorage.setItem('cart', JSON.stringify(cartItems));
    
//             // Hiển thị thông báo xóa sản phẩm thành công
//             alert('Product removed from cart successfully!');
//         } else {
//             // Hiển thị thông báo "Invalid index"
//             alert('Invalid index! Product not found in cart.');
//         }
    
//         // Gọi lại hàm hiển thị giỏ hàng để cập nhật thông tin
//         displayCart();
//     }
// Hàm để hiển thị dữ liệu sản phẩm trên trang web
// function displayProducts(products) {
//     const productContainer = document.querySelector('.product-container');

//     // Xóa nội dung cũ của productContainer trước khi thêm sản phẩm mới
//     productContainer.innerHTML = '';

//     // Lặp qua mảng sản phẩm và tạo thành phần HTML cho mỗi sản phẩm
//     products.forEach(product => {
//         // Tạo một div mới để chứa thông tin sản phẩm
//         const productDiv = document.createElement('div');
//         productDiv.classList.add('product');

//         // Thêm thông tin sản phẩm vào productDiv
//         productDiv.innerHTML = `
//             <img src="data:image;base64,${product.Image}" alt="${product.Name}">
//             <h2>${product.Name}</h2>
//             <p>Giá: ${product.Price}</p>
//             <p>${product.Description}</p>
//             <button class="add-to-cart-btn">Add to Cart</button>
//         `;

//         // Thêm sự kiện click vào nút "Add to Cart"
//         const addToCartBtn = productDiv.querySelector('.add-to-cart-btn');
//         addToCartBtn.addEventListener('click', function() {
//             addToCart(product); // Gọi hàm addToCart khi nhấn vào nút "Add to Cart"
//         });

//         // Thêm productDiv vào productContainer
//         productContainer.appendChild(productDiv);
//     });
// }

// document.addEventListener('DOMContentLoaded', function() {
//     var checkoutBtn = document.getElementById('checkout-btn');
//     if (checkoutBtn) {
//         checkoutBtn.addEventListener('click', function() {
//             var totalItems = document.getElementById('total-items');
//             var totalPrice = document.getElementById('total-price');
//             var inputTotalItems = document.getElementById('input-total-items');
//             var inputTotalPrice = document.getElementById('input-total-price');
//             var checkoutForm = document.getElementById('checkout-form');

//             if (totalItems && totalPrice && inputTotalItems && inputTotalPrice && checkoutForm) {
//                 inputTotalItems.value = totalItems.textContent;
//                 inputTotalPrice.value = totalPrice.textContent;
//                 checkoutForm.submit();
//             } else {
//                 console.error('Some elements are missing on the page.');
//             }
//         });
//     }
// });



// function saveCartData(cartItems) {
//     fetch('save_cart_data.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify(cartItems)
//     })
//     .then(response => response.text())
//     .then(data => alert(data))
//     .catch(error => console.error('Error:', error));
// }

// function calculateTotalAmount(cartItems) {
//     return cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
// }

//let productContents = [];
let currentBackground = 0;

setInterval(() => {
    currentBackground = (currentBackground % 4) + 1;
    console.log('currentBackground:', currentBackground);

    document.body.className = `background${currentBackground}`;
    document.querySelector('header').className = `background${currentBackground}`;
    
    const products = document.querySelectorAll('.product');
    products.forEach((product, index) => {
        const productContent = productContents[currentBackground - 1];
        console.log('productContent:', productContent);

        if (productContent) {
            const productData = productContent[index];
            if (productData) {
                product.querySelector('h2').textContent = productData.Name;
                product.querySelector('.price').textContent = `Price: ${productData.Price}`;
                product.querySelector('.description').textContent = `Description: ${productData.Description}`;
            }
        }
    });
}, 5000);
// setInterval(() => {
//     currentBackground = (currentBackground % 4) + 1;
//     console.log('currentBackground:', currentBackground);

//     document.body.className = `background${currentBackground}`;
//     document.querySelector('header').className = `background${currentBackground}`;
// }, 5000);


