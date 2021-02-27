<template>
    <div>
        <form novalidate class="md-layout" @submit.prevent="validateUser">
            <md-card class="md-layout-item">
                <md-card-header>
                    <div class="md-title">Sign Up</div>
                </md-card-header>

                <md-card-content>
                    <div class="md-layout md-gutter">
                        <div class="md-layout-item">
                            <md-field :class="getValidationClass('first_name')">
                                <label for="first_name">First Name</label>
                                <md-input name="first_name" id="first_name" v-model="form.first_name" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.first_name.required">The first name is required</span>
                                <span class="md-error" v-else-if="!$v.form.first_name.minLength || !$v.form.first_name.maxLength">Invalid first name</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item">
                            <md-field :class="getValidationClass('last_name')">
                                <label for="last_name">Last Name</label>
                                <md-input name="last_name" id="last_name" v-model="form.last_name" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.last_name.required">The last name is required</span>
                                <span class="md-error" v-else-if="!$v.form.last_name.minLength || !$v.form.last_name.maxLength">Invalid last name</span>
                            </md-field>
                        </div>
                    </div>

                    <div class="md-layout md-gutter">

                        <div class="md-layout-item">
                            <md-field :class="getValidationClass('phone')">
                                <label for="phone">Phone Number</label>
                                <md-input id="phone" name="phone" autocomplete="phone" v-model="form.phone" :disabled="sending" />
                                <span class="md-error" v-if="!$v.form.phone.required">The phone is required</span>
                                <span class="md-error" v-else-if="!$v.form.phone.minlength || !$v.form.phone.maxLength">Invalid phone</span>
                            </md-field>
                        </div>

                        <div class="md-layout-item">
                        <md-field :class="getValidationClass('investment_amount')">
                            <label for="investment_amount">investment amount</label>
                            <md-select v-model="form.investment_amount" name="investment_amount" id="investment_amount">
                                <md-option value="100">100</md-option>
                                <md-option value="200">200</md-option>
                                <md-option value="300">300</md-option>
                            </md-select>
                            <span class="md-error" v-if="!$v.form.investment_amount.required">The amount is required</span>
                        </md-field>
                        </div>

                    </div>

                    <md-field :class="getValidationClass('email')">
                        <label for="email">Email</label>
                        <md-input type="email" name="email" id="email" v-model="form.email" :disabled="sending" />
                        <span class="md-error" v-if="!$v.form.email.required">The email is required</span>
                        <span class="md-error" v-else-if="!$v.form.email.email">Invalid email</span>
                    </md-field>

                    <md-field :class="getValidationClass('email_confirmation')">
                        <label for="email_confirmation">Confirm Email Address</label>
                        <md-input type="email" name="email_confirmation" id="email_confirmation" v-model="form.email_confirmation" :disabled="sending" />
                        <span class="md-error" v-if="!$v.form.email_confirmation.required">The email confirmation is required</span>
                        <span class="md-error" v-else-if="!$v.form.email_confirmation.sameAsEmail">Email does not match</span>
                    </md-field>

                    <md-field :class="getValidationClass('password')">
                        <label for="password">Password</label>
                        <md-input name="password" v-model="form.password" type="password" :disabled="sending" />
                        <span class="md-error" v-if="!$v.form.password.required">The password is required</span>
                        <span class="md-error" v-if="!$v.form.password.minLength">Invalid password</span>
                    </md-field>

                    <md-field :class="getValidationClass('password_confirmation')">
                        <label for="password_confirmation">Confirm Password</label>
                        <md-input name="password_confirmation" v-model="form.password_confirmation" type="password" :disabled="sending" />
                        <span class="md-error" v-if="!$v.form.password_confirmation.required">The password is required</span>
                        <span class="md-error" v-else-if="!$v.form.password_confirmation.sameAsPassword">Password does not match</span>
                    </md-field>

                    <md-checkbox v-model="form.is_adult" class="md-primary">I certify that I am 18 years of age or older, and
                        I agree to the Terms of Service and Privacy Policy.</md-checkbox>

                    <md-checkbox v-model="form.subscribe_news" class="md-primary">I would like to receive important information and periodic
                        news updates.</md-checkbox>

                </md-card-content>


                <md-card-actions>
                    <md-button type="submit" class="md-primary" :disabled="sending || !formFilled" >Create Account</md-button>
                </md-card-actions>
            </md-card>

            <md-snackbar :md-active.sync="userSaved">The user {{ lastUser }} was saved with success!</md-snackbar>
        </form>
    </div>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import {
        required,
        email,
        minLength,
        maxLength,
        sameAs
    } from 'vuelidate/lib/validators'

    export default {
        mixins: [validationMixin],
        data: () => ({
            form: {
                first_name: null,
                last_name: null,
                investment_amount: null,
                phone: null,
                email: null,
                email_confirmation: null,
                password: null,
                password_confirmation: null,
                is_adult: null,
                subscribe_news: null,
            },
            userSaved: false,
            sending: false,
            lastUser: null
        }),
        validations: {
            form: {
                first_name: {
                    required,
                    minLength: minLength(2),
                    maxLength: maxLength(12)
                },
                last_name: {
                    required,
                    minLength: minLength(2),
                    maxLength: maxLength(12)
                },
                phone: {
                    required,
                    minLength: minLength(2),
                },
                investment_amount: {
                    required
                },

                email: {
                    required,
                    email,
                },
                email_confirmation:{
                    required, sameAsEmail: sameAs('email')
                },
                password:{
                    required,
                    minLength: minLength(8)
                },
                password_confirmation:{
                    required, sameAsPassword: sameAs('password')
                },
                is_adult:{
                    required,
                },
                subscribe_news:{
                    required,
                },
            }
        },
        methods: {
            getValidationClass (fieldName) {
                const field = this.$v.form[fieldName]

                if (field) {
                    return {
                        'md-invalid': field.$invalid && field.$dirty
                    }
                }
            },
            clearForm () {
                this.$v.$reset()
                this.form.first_name = null
                this.form.last_name = null
                this.form.phone = null
                this.form.investment_amount = null
                this.form.email = null
                this.form.email_confirmation = null
                this.form.password = null
                this.form.password_confirmation = null
                this.form.is_adult = null
                this.form.subscribe_news = null
            },

            async saveUser () {
                this.sending = true;
                let request = await axios.post('/api/sign-up', this.form);
                console.log(request.status)
                if (request.status == 200) {
                    window.location.href = '/list';
                }

            },
            validateUser () {
                this.$v.$touch()

                if (!this.$v.$invalid) {

                    this.saveUser()
                }
            }
        },
        computed: {
            formFilled(){
                return  this.form.first_name &&
                this.form.last_name &&
                this.form.phone &&
                this.form.investment_amount &&
                this.form.email &&
                this.form.email_confirmation &&
                this.form.password &&
                this.form.password_confirmation &&
                this.form.is_adult &&
                this.form.subscribe_news
            }
        }
    }
</script>

<style  scoped>
    .md-progress-bar {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
    }
</style>
