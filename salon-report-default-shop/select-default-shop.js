const selectShopSlectors = document.querySelectorAll( '.js-select-shop' );
window.addEventListener( 'load', () => {
	selectShopSlectors.forEach ( selectShopSlector => {
		selectShopSlector.selected = true;
	} );
} );
