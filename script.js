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

	// Ciekawostki o psach/biglach - lista lokalna (po polsku), losowana w
	// przegladarce. Zadnego zewnetrznego API: bez opoznien sieciowych, bez
	// ryzyka niedzialajacego tlumaczenia czy przerwy w dostepnosci uslugi -
	// idealne pod losowanie co 10 sekund bez obciazania serwera.
	var dogFacts = [
		'Nos biegla ma okolo 220 milionow receptorow wechowych - u czlowieka jest ich tylko okolo 5 milionow.',
		'Dlugie, opadajace uszy biegla pomagaja "zamiatac" zapachy z ziemi w strone nosa podczas tropienia.',
		'Beagle byl pierwotnie hodowany do polowan na zajace i krolikami w grupach zwanych sforami.',
		'Odcisk nosa psa jest tak samo unikalny jak linie papilarne u czlowieka.',
		'Beagle potrafi sledzic trop sprzed kilku dni, nawet czesciowo zatarty przez deszcz.',
		'Psy snia - podczas fazy REM ich mozg wykazuje aktywnosc zblizona do ludzkiej.',
		'Merdanie ogonem w prawo czesciej oznacza pozytywne emocje, a w lewo - niepokoj lub stres.',
		'Psy chlodza sie glownie przez dyszenie - gruczoly potowe maja tylko w opuszkach lap.',
		'Beagle zamiast typowego szczekania potrafi "spiewac" - charakterystyczne wycie nazywa sie baying.',
		'Sluch psa jest okolo czterokrotnie czulszy niz sluch czlowieka.',
		'Dorosly beagle wazy zwykle 9-11 kg, mimo ze sprawia wrazenie wiekszego psa.',
		'Psy maja trzecia powieke (blone migawkowa), ktora chroni oko i utrzymuje je nawilzone.',
		'Beagle uwielbia jedzenie do tego stopnia, ze latwo mu przytyc - warto pilnowac porcji.',
		'Psy potrafia rozpoznawac ludzkie emocje po wyrazie twarzy.',
		'Ziewanie jest zarazliwe nie tylko miedzy ludzmi - psy tez "lapia" ziewanie od wlascicieli.',
		'Beagle to jedna z najstarszych ras psow goniczych w Wielkiej Brytanii.',
	];

	var factEl = document.getElementById( 'dog-fact' );
	var refreshBtn = document.getElementById( 'dog-fact-refresh' );
	var lastFactIndex = -1;

	function showRandomFact() {
		if ( ! factEl ) {
			return;
		}
		var index;
		do {
			index = Math.floor( Math.random() * dogFacts.length );
		} while ( index === lastFactIndex && dogFacts.length > 1 );
		lastFactIndex = index;
		factEl.textContent = dogFacts[ index ];
	}

	showRandomFact();

	if ( refreshBtn ) {
		refreshBtn.addEventListener( 'click', showRandomFact );
	}

	setInterval( showRandomFact, 10000 );

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
