document.addEventListener( 'DOMContentLoaded', function () {

	// Plynne przewijanie do sekcji po kliknieciu w linki z kotwica (#kategorie, #dlaczego-my).
	document.querySelectorAll( 'a[href^="#"]' ).forEach( function ( link ) {
		link.addEventListener( 'click', function ( event ) {
			var target = document.querySelector( link.getAttribute( 'href' ) );
			if ( ! target ) {
				return;
			}
			event.preventDefault();
			target.scrollIntoView( { behavior: 'smooth', block: 'start' } );
		} );
	} );

	// Animacja "wjazdu" kart kategorii podczas przewijania strony.
	var cards = document.querySelectorAll( '.category-card' );

	if ( ! cards.length ) {
		return;
	}

	if ( ! ( 'IntersectionObserver' in window ) ) {
		cards.forEach( function ( card ) {
			card.classList.add( 'is-visible' );
		} );
		return;
	}

	var observer = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( entry.isIntersecting ) {
				entry.target.classList.add( 'is-visible' );
				observer.unobserve( entry.target );
			}
		} );
	}, { threshold: 0.2 } );

	cards.forEach( function ( card ) {
		observer.observe( card );
	} );

} );
