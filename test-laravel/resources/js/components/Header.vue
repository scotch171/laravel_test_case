<template>
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4">Scotch</span>
        </a>

        <ul class="nav nav-pills" v-for="link in links">
            <li class="nav-item"><a :href="link.href" :class="{'active':link.active}" class="nav-link" aria-current="page">{{ link.title }}</a></li>
        </ul>
    </header>
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            links: [
                {
                    title: 'Main page',
                    href: '/',
                    active: false,
                },
                {
                    title: 'Articles',
                    href: '/articles',
                    active: false,
                }
            ]
        }
    },
    methods: {
        setActiveLink() {
            const path = window.location.pathname;

            let maxDeep = 0;
            let tempDeep = 0;
            let linkIndex = 0;

            this.links.forEach((link, index) => {
                tempDeep = this.getHrefDeep(link.href)
                if (path.includes(link.href) && tempDeep > maxDeep) {
                    maxDeep = tempDeep;
                    linkIndex = index;
                }
            });
            this.links[linkIndex].active = true;
        },

        getHrefDeep(href) {
            return href.split('/').filter(element => element !== '').length
        }
    },

    mounted() {
        this.setActiveLink();
    }
}
</script>

<style scoped>

</style>
