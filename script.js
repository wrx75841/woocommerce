document.addEventListener( 'DOMContentLoaded', function () {

	// Plynne przewijanie do sekcji po kliknieciu w linki z kotwica (#o-jadzi, #dolacz).
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

	// Dynamiczna ciekawostka o psach (pobierana z serwera WordPressa, ktory
	// z kolei pyta zewnetrzne API dogapi.dog - patrz functions.php).
	var factEl = document.getElementById( 'dog-fact' );
	var refreshBtn = document.getElementById( 'dog-fact-refresh' );

	function loadDogFact() {
		if ( ! factEl || typeof fanclubJadzi === 'undefined' ) {
			return;
		}
		factEl.textContent = 'Ladowanie ciekawostki...';
		fetch( fanclubJadzi.ajaxUrl + '?action=fanclub_jadzi_dog_fact' )
			.then( function ( response ) { return response.json(); } )
			.then( function ( result ) {
				if ( result.success && result.data && result.data.fact ) {
					factEl.textContent = result.data.fact;
				} else {
					factEl.textContent = 'Nie udalo sie pobrac ciekawostki. Sprobuj ponownie.';
				}
			} )
			.catch( function () {
				factEl.textContent = 'Nie udalo sie pobrac ciekawostki. Sprobuj ponownie.';
			} );
	}

	loadDogFact();

	if ( refreshBtn ) {
		refreshBtn.addEventListener( 'click', loadDogFact );
	}

	// Animacja "wjazdu" kart faktow o Jadzi podczas przewijania strony.
	var cards = document.querySelectorAll( '.fact-card' );

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
