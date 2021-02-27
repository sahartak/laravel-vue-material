<template>
    <div>
        <md-card  v-for="(user, index) in users" :key="user.id">
            <md-card-header>
                <md-card-media>
                    <img src="/images/avatar.png" class="avatar-icon" alt="Avatar">
                </md-card-media>
                <md-card-header-text>
                    <div class="md-title">{{user.first_name}}  {{user.last_name}}</div>
                    <div class="md-subhead">Email : {{ user.email }}</div>
                    <div class="md-subhead">Phone: {{ user.phone }}</div>
                    <div class="md-subhead">Investment amount: {{ user.investment_amount }}</div>
                </md-card-header-text>
                <md-switch @change="changeVacation(user)" class="md-primary" v-model="users[index].on_vacation">On vacation</md-switch>

            </md-card-header>
        </md-card>

    </div>
</template>

<script>
    export default {
        data: () => ({
            users: [],

        }),

        methods: {
            async getUsers () {
                let request = await axios.get('/api/users');
                if (request.status == 200) {
                    this.users = request.data;

                }
            },
            async changeVacation(user) {
                console.log(user)
                let request = await axios.patch('/api/set-vacation/'+user.id, {on_vacation:user.on_vacation});
            }
        },
        mounted() {
            this.getUsers();
        }
    }
</script>

<style  scoped>
    .avatar-icon {
        padding:10px;
    }
    .md-card {
        margin: 20px;
    }
    .md-card-header-text {
        margin-left: 20px;
    }
    .md-switch {
        display: flex;
    }
</style>
