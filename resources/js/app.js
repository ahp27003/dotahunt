/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



import ClickOutside from "vue-click-outside";
import Notifications from 'vue-notification';
import VModal from 'vue-js-modal';
import Tooltip from 'vue-directive-tooltip';
import ToggleButton from 'vue-js-toggle-button';
import KnobControl from 'vue-knob-control';
import flatPickr from 'vue-flatpickr-component';
import VueApexCharts from 'vue-apexcharts';
import { Slide } from 'vue-burger-menu';

Vue.use(VModal, { dialog: true });
Vue.use(ClickOutside);
Vue.use(Notifications);
Vue.use(Tooltip);
Vue.use(ToggleButton);
Vue.use(KnobControl);
Vue.use(flatPickr);
Vue.use(VueApexCharts);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sidebar-component', require('./components/SidebarComponent.vue').default);
Vue.component('tournament-component', require('./components/TournamentComponent.vue').default);
Vue.component('alert-component', require('./components/AlertComponent.vue').default);
Vue.component('noti-component', require('./components/NotiComponent.vue').default);
Vue.component('chat-component', require('./components/ChatComponent.vue').default);
Vue.component('message-component', require('./components/MessageComponent.vue').default);
Vue.component('achievement-component', require('./components/AchievementComponent.vue').default);
Vue.component('stats-component', require('./components/StatsComponent.vue').default);
Vue.component('edit-achievement', require('./components/EditAchievement.vue').default);
Vue.component('map-component', require('./components/MapComponent.vue').default);
Vue.component('mapsearch-component', require('./components/MapsearchComponent.vue').default);
Vue.component('spider-component', require('./components/SpiderComponent.vue').default);
Vue.component('apexchart', VueApexCharts);
new Vue({
    el: '#app',
    components: {
        KnobControl,
        apexchart: VueApexCharts,
        Slide,
    },
    data() {
        return {
            isOpen: true,
            opened: false,
            alert: true,
            team: false,
            notification: false,
            bell: false,
            count: 0,
            chat: false,
            thread: Object,
            sendto: String,
            account: String,
            toggleRec: false,
            winrate: 0,
            gpm: 0,
            xppm: 0,
            lasthit: 0,
            tower_dmg: 0,
            hero_dmg: 0,
            ward: 0,
            deward: 0,
            kills: 0,
            death: 0,
            assists: 0,
            date: null,

        };
    },

    created() {
        var userId = $('meta[name="userId"]').attr("content");
        var kira = $('meta[name="noticount"]').attr("content");
        //console.log(kira);
        this.count = parseInt(kira);
        Echo.private("App.User." + userId).notification(notification => {
            this.bell = true;
            this.count++;
        });
    },

    methods: {
        getThread(data, user, acc) {
            this.thread = data;
            this.sendto = user.name;
            this.account = acc.avatar_url;
            this.chat = true;
        },
        toggle() {
            this.isOpen = !this.isOpen;
        },

        onoff() {
            this.opened = !this.opened;
        },

        hide() {
            this.opened = false;
        },
        hides() {
            this.team = false;
        },
        hideAlert() {
            this.alert = false;
        },
        dropTeam() {
            this.team = !this.team;
        },
        hideNoti() {
            this.notification = false;
        },
        noti() {
            this.notification = !this.notification;
        },
        onChangeEventHandler() {
            this.toggleRec = !this.toggleRec;
        },
        toWord(val) {
            const map = {
                0: 'any',
                200: '200+',
                400: '400+',
                600: '600+',
                800: '800+',
            }
            return map[val];
        },
        toWord2(val) {
            const map = {
                0: 'any',
                100: '100+',
                200: '200+',
                300: '300+',
                400: '400+',
            }
            return map[val];
        },
        toWord3(val) {
            const map = {
                0: 'any',
                3000: '3000+',
                6000: '6000+',
                9000: '9000+',
            }
            return map[val];
        },
        toWord4(val) {
            const map = {
                0: 'any',
                10000: '10000+',
                20000: '20000+',
                30000: '30000+',
            }
            return map[val];
        },
        toWord5(val) {
            const map = {
                0: 'any',
                5: '5+',
                10: '10+',
                15: '15+',
                20: '20+',
            }
            return map[val];
        },
        deleteTeam(id) {
            //console.log(id);
            this.$modal.show('dialog', {
                title: 'Alert!',
                text: 'Are you sure want to delete this team?',
                class: ['bg-dark-100', 'text-white'],
                buttons: [
                    {
                        title: 'Close'
                    },
                    {
                        title: 'Proceed',
                        default: true,
                        handler: () => {
                            axios.delete('/teams/' + id);
                            alert("Succesfully deleted");
                            location.reload();
                        }
                    }

                ]
            })
        },
        kickPlayer(playerId, teamId) {
            this.$modal.show('dialog', {
                title: 'Alert!',
                text: 'Are you sure want to kick this player?',
                class: ['bg-dark-100', 'text-white'],
                buttons: [
                    {
                        title: 'Close'
                    },
                    {
                        title: 'Proceed',
                        default: true,
                        handler: () => {
                            axios.get('/kick/' + playerId + '/team/' + teamId);
                            alert("The user has been kick!");
                            location.reload();
                        }
                    }

                ]
            })
        },
        leaveTeam(teamId) {
            this.$modal.show('dialog', {
                title: 'Alert!',
                text: 'Are you sure want to leave this team?',
                class: ['bg-dark-100', 'text-white'],
                buttons: [
                    {
                        title: 'Close'
                    },
                    {
                        title: 'Proceed',
                        default: true,
                        handler: () => {
                            axios.get('/leave/' + teamId);
                            alert("Succesfully left");
                            window.location.href = '/teams';
                        }
                    }

                ]
            })
        }
    },

    directives: {
        ClickOutside
    }
});
