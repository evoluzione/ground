import Highway from '@dogstudio/highway';
import Tween from 'gsap';

class Fade extends Highway.Transition {
	in({ from, to, trigger, done }) {
		// Reset Scroll
		window.scrollTo(0, 0);

		// Remove Old View
		from.remove();

		// Animation
		Tween.fromTo(
			to,
			0.5,
			{ opacity: 0 },
			{
				opacity: 1,
				onComplete: done
			}
		);
	}

	out({ from, trigger, done }) {
		// Animation
		Tween.fromTo(
			from,
			0.5,
			{ opacity: 1 },
			{
				opacity: 0,
				onComplete: done
			}
		);
	}
}

export default Fade;
