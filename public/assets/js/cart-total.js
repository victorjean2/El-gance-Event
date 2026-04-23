document.addEventListener('DOMContentLoaded', function () {
    const cartRows = document.querySelectorAll('.cart-row');
    const grandTotalElement = document.querySelector('#cart-grand-total');

    if (cartRows.length === 0 || !grandTotalElement) {
        return;
    }

    function formatPrice(amount) {
        return amount.toFixed(2).replace('.', ',') + ' €';
    }

    function updateLineTotal(row) {
        const price = parseFloat(row.dataset.price);
        const quantityInput = row.querySelector('[data-quantity-input]');
        const lineTotalElement = row.querySelector('[data-line-total]');

        if (!quantityInput || !lineTotalElement || isNaN(price)) {
            return 0;
        }

        let quantity = parseInt(quantityInput.value, 10);

        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            quantityInput.value = 1;
        }

        const lineTotal = price * quantity;
        lineTotalElement.textContent = formatPrice(lineTotal);

        return lineTotal;
    }

    function updateGrandTotal() {
        let grandTotal = 0;

        cartRows.forEach(function (row) {
            grandTotal += updateLineTotal(row);
        });

        grandTotalElement.textContent = formatPrice(grandTotal);
    }

    cartRows.forEach(function (row) {
        const quantityInput = row.querySelector('[data-quantity-input]');

        if (!quantityInput) {
            return;
        }

        quantityInput.addEventListener('input', function () {
            updateLineTotal(row);
            updateGrandTotal();
        });

        quantityInput.addEventListener('change', function () {
            updateLineTotal(row);
            updateGrandTotal();
        });
    });

    updateGrandTotal();
});