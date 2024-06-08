const checkMenu = document.getElementsByClassName( 'js-check-menu' );
const menuStaff = document.getElementsByClassName( 'js-menu-staff' );

const fillboxTitle = document.getElementsByClassName( 'js-check-menu-title' );
const checkDesignate = document.getElementsByClassName( 'js-check-designate' );

const menuDesignate = document.getElementsByClassName( 'js-menu-designate' );

for( let i = 0; i < checkMenu.length; i++ ) {
	if ( checkMenu[ i ].checked ) {
		menuStaff[ i ].style.display = "block";
		menuDesignate[ i ].style.display = "block";
		fillboxTitle[ i ].style.backgroundColor = "#93F5D7";
	}
	checkMenu[i].addEventListener( 'change', function() {
		if ( checkMenu[ i ].checked ) {
			menuStaff[ i ].style.display = "block";
			menuDesignate[ i ].style.display = "block";
			fillboxTitle[ i ].style.backgroundColor = "#93F5D7";
		} else {
			menuStaff[ i ].style.display = "none";
			menuDesignate[ i ].style.display = "none";
			fillboxTitle[ i ].style.backgroundColor = "#eee";
			for( const option of menuStaff[i].options ) {
				option.selected = false;
				checkDesignate[ i ].checked = false;
				menuStaff[ i ].style.backgroundColor = "#eee";
			}
		}
	} );
}

for( let i = 0; i < checkDesignate.length; i++ ) {
	if ( checkDesignate[ i ].checked ) {
		menuStaff[ i ].style.backgroundColor = "#93F5D7";
	}
	checkDesignate[i].addEventListener( 'change', function() {
		if ( checkDesignate[ i ].checked ) {
			menuStaff[ i ].style.backgroundColor = "#93F5D7";
		} else {
			menuStaff[ i ].style.backgroundColor = "#eee";
		}
	} );
}
