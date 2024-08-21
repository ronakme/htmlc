// Sample menu data to simulate dynamically loaded items
const menuItems = [
    {
        name: "Signature Coffee",
        description: "Rich, bold espresso with a smooth, creamy finish.",
        price: "$4.50",
        image: "coffee.jpg"
    },
    {
        name: "Fresh Croissant",
        description: "Flaky, buttery pastry baked to perfection.",
        price: "$3.00",
        image: "croissant.jpg"
    },
    {
        name: "Iced Latte",
        description: "Chilled espresso with a touch of sweetness and milk.",
        price: "$5.00",
        image: "iced-latte.jpg"
    },
    {
        name: "Chocolate Muffin",
        description: "A rich, moist muffin with chunks of dark chocolate.",
        price: "$2.75",
        image: "muffin.jpg"
    },
    {
        name: "Vanilla Frappe",
        description: "A creamy and delicious cold vanilla beverage.",
        price: "$4.75",
        image: "frappe.jpg"
    },
    {
        name: "Blueberry Pancakes",
        description: "Light and fluffy pancakes topped with fresh blueberries.",
        price: "$6.00",
        image: "pancakes.jpg"
    }
];

// Function to create a menu item element
function createMenuItem(item) {
    const menuItem = document.createElement("div");
    menuItem.classList.add("menu-item");

    menuItem.innerHTML = `
        <img src="${item.image}" alt="${item.name}">
        <h3>${item.name}</h3>
        <p>${item.description}</p>
        <span class="price">${item.price}</span>
    `;

    return menuItem;
}

// Function to load menu items dynamically
function loadMenuItems(startIndex, count) {
    const menuContainer = document.getElementById("menu-container");

    for (let i = startIndex; i < startIndex + count && i < menuItems.length; i++) {
        const menuItem = createMenuItem(menuItems[i]);
        menuContainer.appendChild(menuItem);
    }
}

// Load more items when "Load More" button is clicked
document.getElementById("load-more-btn").addEventListener("click", function () {
    const currentItems = document.querySelectorAll(".menu-item").length;
    loadMenuItems(currentItems, 2);

    // Hide button if all items are loaded
    if (currentItems + 2 >= menuItems.length) {
        this.style.display = "none";
    }
});

// Initial load of the first few menu items
loadMenuItems(0, 3);
