<template>
    <div class="container">
        <h2>Dashboard : </h2>
        <button type="button" class="btn btn-dark mt-2" @click="logout">Logout</button>
        <p>
            <span class="text-success">Email : </span>
            <span class="text-danger">{{ email }}</span>
        </p>
    </div>
</template>
<script>
    import { useRouter } from "vue-router"
    import { useStore } from 'vuex'
    export default{
        setup(){
            const router = useRouter();
            const store = useStore();

            function logout(){
                store.dispatch('removeToken');
                router.push({name:'Home'})
            }
            //console.log(name.email);

            return {
                email: store.getters.email,
                email: store.getters.getEmail,
                logout
            }
        }
    }
</script>
