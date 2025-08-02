// Add an event listener to the document to to execute the function when the DOM is fully loaded.
document.addEventListener("DOMContentLoaded", function () {
    // Select all dropdown elements with class 'option-select' to every dropdown element
    const selectElements = document.querySelectorAll('.option-select');
    // For each dropdown element, update the image, price, and name of the product based on the selected option.
    selectElements.forEach(select => {
        // Add an event listener that fires when the user changes the selected option
        select.addEventListener('change', function () {
            const selectedOption = select.selectedOptions[0];
            // Exit if no option is selected
            if (!selectedOption) {
                return;
            }

            // Get custom data attributes from the selected option
            const newImg = selectedOption.dataset.img;
            const newPrice = selectedOption.dataset.price;
            const newName = selectedOption.dataset.name;

            // Update the image, price, and name of the product if the custom data attributes exist
            if (newImg) {
                    document.getElementById('product-image').src = newImg;
                }
            if (newPrice) {
                document.getElementById('product-price').textContent = parseFloat(newPrice);
            }
            if (newName) {
                document.getElementById('product-name').textContent = newName;
            }
        });
    });

    // For the theme selector
    const themeSelector = document.getElementById("theme-selector"); // Get the theme selector element

    // Define the theme colors
    const themes = {
        default: { "--bg-color": "#ffffff", "--text-color": "#000000" }, // Basic default
        winter: { "--bg-color": "#f0f8ff", "--text-color": "#1e3a8a" },
        spring: { "--bg-color": "#a8e6cf", "--text-color": "#34495e" },
        
    };

    // Check if the user select the default theme, and if so, clear the theme
    function applyTheme(themeName) {
        if (themeName === "default") {
            clearTheme();
            return;
        }
        // Otherwise, apply the theme based on the selected theme name
        const theme = themes[themeName] || themes[getAutomaticTheme()]; 
        // Apply the theme by setting the CSS variables for the background and text colors
        Object.keys(theme).forEach((key) => { // Loop through each key (CSS variable) and then sets the respective property's 
            document.documentElement.style.setProperty(key, theme[key]);  
        });
    }

    // This is used to get the theme from the local storage and apply it to the page (to make sure the theme is applied when the page refreshes)
    const savedTheme = localStorage.getItem("selectedTheme") || "auto"; // Gets the theme from the local storage
    applyTheme(savedTheme === "auto" ? getAutomaticTheme() : savedTheme); 

    // Set up theme selector change to handle theme selection only if it exists on the page
    if (themeSelector) {
        themeSelector.value = savedTheme;  // Sets the selected theme to the one saved in the local storage

        // Update theme whenever user changes selection
        themeSelector.addEventListener("change", function () {
            const selectedTheme = themeSelector.value; // Gets the selected theme
            localStorage.setItem("selectedTheme", selectedTheme); // Make sure to save the selected theme in the local storage so the theme is applied when the page refreshes
            applyTheme(selectedTheme);  // Apply the selected theme
        });
    }
    // The function will clear the theme by removing the CSS variables for background and text colors
    function clearTheme() {
        document.documentElement.style.removeProperty("--bg-color");
        document.documentElement.style.removeProperty("--text-color");
    }
});