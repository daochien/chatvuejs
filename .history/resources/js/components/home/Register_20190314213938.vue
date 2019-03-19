<template>
    <div class="col-md-8">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Form register</div>
                    <div class="card-body">
                        <form @submit.prevent="register()">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input v-model="form.username" type="text" name="username" class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                                    <has-error :form="form" field="username"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input v-model="form.first_name" type="text" name="first_name" class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }">
                                    <has-error :form="form" field="first_name"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-6">
                                    <input v-model="form.last_name" type="text" name="last_name" class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }">
                                    <has-error :form="form" field="last_name"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input v-model="form.email" type="text" name="email" class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input v-model="form.password" type="password" name="password" class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input v-model="form.password_confirm" type="password" name="password_confirm" class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirm') }">
                                    <has-error :form="form" field="password_confirm"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    data(){
        return {
            form: new Form({
                username: '',
                password: '',
                email: '',
                first_name: '',
                last_name: '',
                avatar: '',
                password_confirm: ''
            })
        }
    },
    methods:{
        register(){
            this.$Progress.start();
            this.form.post('api/user/register').then( ({data}) => {
                if(data.status == true){
                    Swal.fire({ type: 'success', title: 'Success', text: data.msg});
                    this.$router.push({name: 'login'})
                } else {
                    Swal.fire({ type: 'error', title: 'Oops...', text: data.msg});
                }
            }).catch( (errors) => {
                console.log(errors);
                //Swal.fire({ type: 'error', title: 'Oops...', text: 'Something went wrong!'});
            });
            this.$Progress.finish();
        }
    }
}
</script>
<style>

</style>


