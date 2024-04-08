
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
        //var newImagePath = "images/Laptop_Dell_XPS_13.jpg";

        // Thay thế đường dẫn hình trong chuỗi HTML
        productDiv.innerHTML = `
            <img src="data:image;base64,${product.Image}" alt="${product.Name}">
            <h2>${product.Name}</h2>
            <p>Price: ${product.Price}</p>
            <p>Description: ${product.Description}</p>
            <button>Add to Cart</button>
        `;

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


