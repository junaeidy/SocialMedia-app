import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { CkeditorPlugin } from '@ckeditor/ckeditor5-vue';

const html = window.document.documentElement
const darkMode = parseInt(localStorage.getItem('darkMode') || 1)
if (darkMode) {
    html.classList.add('dark')
} else {
    html.classList.remove('dark')
}

const appName = import.meta.env.VITE_APP_NAME || 'Discussy';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(CkeditorPlugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#0394fc',
        showSpinner: true,
    },
});
