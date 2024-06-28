window.addEventListener( 'load', function ( e ) {
	const updateButton = document.querySelector( '.editor-post-publish-button__button' );
	updateButton.addEventListener( 'click', function ( e ) {
		e.preventDefault();
		datas.forEach( ( data, index ) => {
			let postbox = document.querySelector( '#customer_data' + index );
			let error_message_date = postbox.children[1].children[2].children[0].children[1].children[1];
			let error_message_menus = postbox.children[1].children[2].children[2].children[1].children;
			let selectorStaffs = postbox.querySelectorAll( '.js-menu-staff' );
			let error_flog = true;
			if ( ! postbox.classList.contains( 'closed' ) ) {
				error_flog = validateTime ( postbox, error_message_date, index );
				error_flog = validateStaff( postbox, error_message_menus, index );
			}
		} );
		return false;
	} );
} );

let validateTime = ( postbox, error_message, index ) => {
	let getTime = postbox.querySelector( 'input[name="customer_visit_datetime_customer_data_report' + index + '"]' );
	if ( ! getTime?.value ) {
		error_message.style.display = 'block';
		// e.preventDefault();
		return false;
	} else {
		error_message.style.display = 'none';
		return true;
	}
}

let validateStaff = ( postbox, error_message_datas, index ) => {
	let selectorStaffs = postbox.querySelectorAll( '.js-menu-staff' );
	selectorStaffs.forEach( selectorStaff => {
		let menuLabel = selectorStaff.parentElement.parentElement.children[0];
		if ( menuLabel.classList.contains( 'is-open' ) ) {
			let menuList = menuLabel.parentElement.children[1].children[0];
			let menuListChildren = menuList.children;
			let error_message = menuList.parentElement.children[2];
			let flg = [];
			Array.prototype.forEach.call( menuListChildren, ( menuListChild, index ) => {
				if ( menuListChild.selected == true ) {
					flg[index] = true;
				} else {
					flg[index] = false;
				}
			} );
			if ( flg[0] ) {
				error_message.style.display = 'block';
				return false;
			} else {
				error_message.style.display = 'none';
				return true;
			}
		}
	} );
}
