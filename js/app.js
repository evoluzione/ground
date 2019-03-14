import 'lazysizes';
import InfiniteScroll from './components/infiniteScroll.js';
import Modal from './components/modal.js';
import Navigation from './components/navigation.js';
import Slider from './components/slider.js';
//import Parallax from './components/parallax.js';
import Loader from './components/loader.js';
import Split from './components/split.js';
import Toggle from './components/toggle.js';

const infiniteScroll = new InfiniteScroll;
const loader = new Loader;
const modal = new Modal();
const navigation = new Navigation;
const sliderPrimary = new Slider('.js-slider-primary');
const sliderSecondary = new Slider('.js-slider-secondary');
const split = new Split();
const toggle = new Toggle();
//const parallax = new Parallax('.js-parallax');