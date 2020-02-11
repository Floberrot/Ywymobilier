
new Vue({
    el: '#app',
    delimiters: ['${', '}'],
    data: {
        properties: [],
        searchText: '',
        },
    computed: {
        filteredProperty() {
            return this.properties
                .filter(property => {
                    return !this.searchText
                        || (property.title).toLowerCase().includes(this.searchText.toLowerCase());
                })
        },
    },
    methods: {
        async fetchUsers() {
            this.searchText = '';
            const { data } = await axios.get('/offres/get');
            this.properties = data;
        },
    },
    mounted() {
        this.fetchUsers();
    }
});