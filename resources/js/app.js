import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const themeRoot = document.documentElement;
const themeStorageKey = 'theme';

const applyTheme = (mode) => {
	if (mode === 'dark') {
		themeRoot.classList.add('dark');
	} else {
		themeRoot.classList.remove('dark');
	}

	document.querySelectorAll('[data-theme-icon="light"]').forEach((icon) => {
		icon.classList.toggle('hidden', mode !== 'light');
	});
	document.querySelectorAll('[data-theme-icon="dark"]').forEach((icon) => {
		icon.classList.toggle('hidden', mode !== 'dark');
	});
};

const initTheme = () => {
	const stored = localStorage.getItem(themeStorageKey);
	if (stored === 'light' || stored === 'dark') {
		applyTheme(stored);
		return;
	}
	const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
	applyTheme(prefersDark ? 'dark' : 'light');
};

const toggleTheme = () => {
	const isDark = themeRoot.classList.contains('dark');
	const next = isDark ? 'light' : 'dark';
	localStorage.setItem(themeStorageKey, next);
	applyTheme(next);
};

document.addEventListener('DOMContentLoaded', () => {
	initTheme();
	document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
		button.addEventListener('click', toggleTheme);
	});
});
