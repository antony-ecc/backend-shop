export function calculateDiscount(product) {
    if(!product) {
        return 0;
    }

    const price = Number(product.price);
    const discount = Number(product.discount);

    if (isNaN(price) || isNaN(discount)) {
        return 0;
    }

    return price - (price * discount / 100);
}

export function moneyFormat(number) {
    const num = Number(number);

    if(isNaN(num)) {
        return 0;
    }

    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 2,
    }).format(number);
}