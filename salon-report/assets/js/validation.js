let dates = [];
for ( let index = 0; index < datas.length; index++ ) {
	//change date check
	document.querySelectorAll( 'input[name="customer_visit_datetime_customer_data_report' + index + '"]' )
	.forEach( ( date, index ) => {
		date.addEventListener( 'change', function ( e ) {
			validation();
		} );
	} );
}
let menus = document.querySelectorAll( '.customer_form_field__multibox' );
for( let i = 0; i < menus.length; i++ ) {
	for ( let j = 0; j < menus[i].children.length; j++ ) {
		menus[i].children[j].addEventListener( 'change', function ( e ) {
			validation();
		} );
	}
}
// document.querySelectorAll( '.customer_form_field__multibox' )
// .forEach( ( item, index ) => {
// 	item.querySelector( '.js-check-menu-title' ).addEventListener( 'click', function( e ) {
// 		validation();
// 		// if ( this.classList.contains( 'is-open' ) ) {
// 		// 	console.log( this );
// 		// 	this.addEventListener( 'checnge', function( e ) {
// 		// 	} );
// 		// }
// 	})
// } );



window.addEventListener( 'load', function ( e ) {
	validation();
	// state();
} );

let validation = () => {
	const updateButton = document.querySelector( '.editor-post-publish-button__button' );
	error_flg = dataCheck();
	if ( error_flg.includes( 'error' ) ) {
		updateButton.ariaDisabled = "true";
		updateButton.addEventListener( 'click', function ( e ) {
			e.preventDefault();
			e.stopPropagation();
		} );
	} else {
		updateButton.ariaDisabled = "false";
	}
}

let state = () => {

	for ( let index = 0; index < datas.length; index++ ) {
		let postbox = document.querySelector( '#customer_data' + index );
		if ( ! postbox.classList.contains( 'closed' ) ) {
			postbox.classList.add( 'open' );
		}
	}
}

let dataCheck = () => {
	const error_flg = [];
	const toglle_chk = [];
	for ( let index = 0; index < datas.length; index++ ) {
		let postbox = document.querySelector( '#customer_data' + index );
		let field_items = postbox.querySelectorAll( '.customer_form_field__multibox__item' );
		let error_date = postbox.querySelector( '.is-date' );
		let error_menus = postbox.querySelectorAll( '.is-staff' );
		let selectorStaffs = postbox.querySelectorAll( '.js-menu-staff' );
		if ( ! postbox.classList.contains( 'closed' ) ) {
			toglle_chk.push( 'open' + index );
			error_flg.push( validateTime ( postbox, error_date, index ) );
			for ( let item_count = 0; item_count < field_items.length; item_count++ ) {
				error_flg.push( validateStaff( postbox, error_menus, field_items,  item_count ) );
			}
		}
	}
	return error_flg;
}

let validateTime = ( postbox, error_date, index ) => {
	let getTime = postbox.querySelector( 'input[name="customer_visit_datetime_customer_data_report' + index + '"]' );
	if ( ! getTime?.value ) {
		error_date.style.display = 'block';
		return 'error';
	} else {
		error_date.style.display = 'none';
		return 'success';
	}
}

let validateStaff = ( postbox, error_menus, field_items, item_count ) => {
	let labels = field_items[ item_count ].querySelector( '.js-check-menu-title' );
	let selectors = field_items[ item_count ].querySelector( '.js-menu-staff' );
	for ( let i = 0; i < selectors.length; i++ ) {
		if ( labels.classList.contains( 'is-open' ) && selectors[i].selected ) {
			error_menus[item_count].style.display = 'block';
			return 'error';
		} else {
			error_menus[item_count].style.display = 'none';
			return 'success';
		}
	}
}
