<template>
    <div class="max-w-sm mx-auto">
        <div class="card">
            <form class="needs-validation mb-4" novalidate>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <input type="text" class="form-control md:uppercase" v-model="name" @input="$v.name.$touch" :class="{'is-invalid': $v.name.$error}" id="passer-name" placeholder="Name">
                        <div class="invalid-feedback" v-if="$v.name.$error">
                            This field is required
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <input type="text" class="form-control md:uppercase" v-model="school" @input="$v.school.$touch" :class="{'is-invalid': $v.school.$error}" id="passer-school" placeholder="School">
                        <div class="invalid-feedback" v-if="$v.school.$error">
                            This field is required
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <input type="text" class="form-control md:uppercase" v-model="campus" @input="$v.campus.$touch" :class="{'is-invalid': $v.campus.$error}" id="passer-campus" placeholder="Campus">
                        <div class="invalid-feedback" v-if="$v.campus.$error">
                            This field is required
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <input type="text" class="form-control md:uppercase" v-model="division" @input="$v.division.$touch" :class="{'is-invalid': $v.division.$error}" id="passer-division" placeholder="Division">
                        <div class="invalid-feedback" v-if="$v.division.$error">
                            This field is required
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" @click.prevent="submit">Submit form</button>
                <router-link :to="{ name: 'home'}" class="btn btn-danger">Back</router-link>
            </form>
            <div class="alert alert-success" role="alert" v-if="success">
                You have successfully added a passer! <a href="#" class="alert-link">Go Back Now</a>.
            </div>
        </div>
    </div>
</template>


<script>
    import { required } from 'vuelidate/lib/validators'

    export default {
        data() {
            return {
                name: "",
                school: "",
                campus: "",
                division: "",
                success: false
            }
        },
        methods: {
            submit() {
                if (this.valid) {
                    axios.post('/api/passers', {
                        passer: {
                            name: this.name.toUpperCase(),
                            school: this.school.toUpperCase(),
                            division: this.division.toUpperCase(),
                            campus: this.campus.toUpperCase()
                        }
                    }).then(response => {
                        if (response.status == 200 && response.data.passer.id) {
                            this.success = true
                            setTimeout(() => {
                                this.clearFields()
                                this.$router.push({name: 'home'})
                            }, 3000)
                        }
                    })
                    .catch((error) => {
                        throw new Error(`Error fetching ${error}`)
                    })
                } else {
                    this.$v.name.$touch()
                    this.$v.campus.$touch()
                    this.$v.school.$touch()
                    this.$v.division.$touch()
                }
            },
            clearFields() {
                this.name = ""
                this.school = ""
                this.campus = ""
                this.division = ""
            }
        },
        computed: {
            valid() {
                return !this.$v.$invalid
            }
        },
        validations: {
            name: {
                required,
            },
            school: {
                required,
            },
            campus: {
                required,
            },
            division: {
                required
            }
        }
    }
</script>
