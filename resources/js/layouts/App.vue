<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <router-link :to="{ name: 'home' }" class="navbar-brand"
                >Test app</router-link
            >
            <button
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'task1' }"
                        >
                            Task1
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'task2' }"
                        >
                            Task2
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'task3' }"
                        >
                            Task3
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            class="nav-link"
                            data-toggle="collapse"
                            :to="{ name: 'task4' }"
                        >
                            Task4
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <router-view></router-view>
        </div>

        <nav class="navbar navbar-expand-md navbar-dark bg-white shadow-sm fixed-bottom ">
            <table class="table">
                <tbody>
                    <tr>
                    <th scope="row">IP ADDRESS:</th>
                    <td>{{this.userinfo['ip']}}</td>
                    </tr>
                    <tr>
                    <th scope="row">USER AGENT:</th>
                    <td>{{this.userinfo['useragent']}}</td>
                    </tr>
                </tbody>
            </table>
        </nav>
    </div>
</template>
<script>
export default {
data(){
    return {
        userinfo: {},
    }
},
created() {
    this.fetchUserInfo();
    
},

methods: {
    fetchUserInfo(){
        fetch('api/userinfo')
            .then(res => res.json())
            .then(res => {
                this.userinfo = res;
            })
    }
}   
};
</script>
