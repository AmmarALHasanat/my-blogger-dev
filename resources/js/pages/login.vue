<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">

                <h2>Login</h2>  
                <p class="text-danger" v-for="error in errors" :key="error">
                    <span v-for="err in error" :key="err">{{ err }}</span>
                </p>
                
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" v-model="form.email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" v-model="form.password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import { reactive,ref } from 'vue'
    import { useRouter } from "vue-router"
    import { useStore } from 'vuex'
    export default{
        setup(){
            const router = useRouter()
            const store = useStore()
            let form = reactive({
                email: '',
                password: ''
            });
            let errors = ref([''])

            const login = async() =>{
                await axios.post('/api/user/login',form).then(res=>{
                    if(res.data.success){
                        store.dispatch('setEmail',res.data.data.email);
                        store.dispatch('setToken',res.data.data.token);
                        router.push({name:'Dashboard'})
                    }
                }).catch(e=>{
                    // error.value = e.response.data.message
                    errors.value = e.response.data.errors
                    if(errors.value==undefined){
                        errors.value = [e.response.data.message]
                    }
                })
            }
            return{
                form,
                login,
                errors
            }
        }
    }
</script>
