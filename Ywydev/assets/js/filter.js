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
                        || (property.title).split(' ')
                        || (property.title).toLowerCase().includes(this.searchText.toLowerCase());
                })
                // .filter(user => {
                //     return (this.gender === 'other' || this.gender === user.gender);
                // })
                // .sort((user1, user2) => {
                //     return (user1.dob.age - user2.dob.age) * this.ageSorting;
                // });
        },
    },
    methods: {
        async fetchUsers() {
            this.searchText = '';
            const { data } = await axios.get('/offres/get');
            this.properties = data;
        },
        // coucou() {
        //     alert('coucou !');
        // },
        // setAgeSorting() {
            // const nextSteps = {
            //     '0': 1,
            //     '1': -1,
            //     '-1': 0,
            // };
            // this.ageSorting = nextSteps[this.ageSorting.toString()];
    //     },
    },
    mounted() {
        this.fetchUsers();
    }
});