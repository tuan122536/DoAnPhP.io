// Tạo ra mảng chứa nội dung hoặc thuộc tính tương ứng với từng sản phẩm cho mỗi background
const productContents = [
    // Nội dung sản phẩm cho background 1
    [
        {
            name: "Graphics Card AORUS RTX 3080",
            price: "$899",
            description: "Description for Graphics Card AORUS RTX 3080."
        },
        {
            name: "Keyboard AORUS K7",
            price: "$149",
            description: "Description for Keyboard AORUS K7."
        }
        // Thêm các sản phẩm khác nếu cần
    ],
    // Nội dung sản phẩm cho background 2
    [
        {
            name: "Graphics Card AORUS RTX 3080 (Customized)",
            price: "$999",
            description: "Description for Customized Graphics Card AORUS RTX 3080."
        },
        {
            name: "Mouse AORUS M5",
            price: "$79",
            description: "Description for Mouse AORUS M5."
        }
        // Thêm các sản phẩm khác nếu cần
    ],
    // Tương tự cho các background còn lại
    // ...
];

let currentBackground = 0;
setInterval(() => {
    currentBackground = (currentBackground % 4) + 1;
    document.body.className = `background${currentBackground}`;
    document.querySelector('header').className = `background${currentBackground}`;
    const products = document.querySelectorAll('.product');
    products.forEach((product, index) => {
        const productContent = productContents[currentBackground - 1][index];
        product.querySelector('h2').textContent = productContent.name;
        product.querySelector('.price').textContent = `Price: ${productContent.price}`;
        product.querySelector('.description').textContent = `Description: ${productContent.description}`;
    });
}, 5000); // Thay đổi background mỗi 5 giây
