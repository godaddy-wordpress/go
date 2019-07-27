import SwitcherControl from './customizer/controls/switcher-control';

const api = wp.customize;

api.controlConstructor = {
	...api.controlConstructor,
	maverick_switcher_control: SwitcherControl, // eslint-disable-line camelcase
};
