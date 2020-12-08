<template>
    <div>
        <b-card title="Formulário para contato">
            <div>
                <b-row>
                    <b-col md="12">
                        <b-form-group
                            id="name-label"
                            label="Nome:"
                            label-for="name-input"
                        >
                            <b-form-input
                                :class="{ 'is-invalid': errorsVeeValidate.has('nome') }"
                                id="name-input"
                                v-model="contact.name"
                                placeholder="João da Silva"
                                type="text"
                                name="nome"
                                v-validate="{
                                required: true,
                                max: 255,
                                min: 3
                            }"
                            ></b-form-input>
                            <b-form-text text-variant="danger">{{ errorsVeeValidate.first('nome') }}</b-form-text>
                        </b-form-group>
                    </b-col>

                </b-row>
                <b-row>
                    <b-col md="6">
                        <b-form-group
                            id="email-label"
                            label="Email:"
                            label-for="email-input"
                        >
                            <b-form-input
                                :class="{ 'is-invalid': errorsVeeValidate.has('email') }"
                                id="email-input"
                                v-model="contact.email"
                                type="email"
                                name="email"
                                v-validate="{
                                required: true,
                                email: true
                            }"
                            ></b-form-input>
                            <b-form-text text-variant="danger">{{ errorsVeeValidate.first('email') }}</b-form-text>
                        </b-form-group>
                    </b-col>
                    <b-col md="6">
                        <b-form-group
                            id="phone-label"
                            label="Telefone:"
                            label-for="phone-input"
                        >
                            <b-form-input
                                :class="{ 'is-invalid': errorsVeeValidate.has('telefone') }"
                                id="phone-input"
                                name="telefone"
                                v-mask="'###########'"
                                v-validate="{
                                   required: true,
                                   min: 9,
                                   max: 11
                                }"
                                v-model="contact.phone"
                            ></b-form-input>
                            <b-form-text text-variant="danger">{{ errorsVeeValidate.first('telefone') }}</b-form-text>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="12">
                        <b-form-group
                            id="message-label"
                            label="Mensagem:"
                            label-for="message-textarea"
                        >
                            <b-form-textarea
                                :class="{ 'is-invalid': errorsVeeValidate.has('mensagem') }"
                                id="message-textarea"
                                v-model="contact.message"
                                placeholder="Sua mensagem..."
                                name="mensagem"
                                v-validate="{
                                required: true
                            }"
                            ></b-form-textarea>
                            <b-form-text text-variant="danger">{{ errorsVeeValidate.first('mensagem') }}</b-form-text>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <b-col md="12">
                        <b-form-group
                            id="file-label"
                            label="Arquivo (doc, docx, odt, pdf):"
                            label-for="file-input"
                        >
                            <b-form-file
                                :class="{ 'is-invalid': errorsVeeValidate.has('arquivo') }"
                                id="file-input"
                                v-model="contact.file"
                                placeholder="Choose a file or drop it here..."
                                drop-placeholder="Drop file here..."
                                name="arquivo"
                                v-validate="{
                                required: true,
                                ext: ['doc', 'docx', 'odt', 'pdf'],
                                size: 25600
                            }"
                            ></b-form-file>
                            <b-form-text text-variant="danger">{{ errorsVeeValidate.first('arquivo') }}</b-form-text>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-button block @click="submit" variant="primary">Enviar</b-button>
            </div>
        </b-card>
    </div>
</template>

<script>

export default {
    props: {
      url: String
    },
    data() {
        return {
            contact: {
                name: '',
                email: '',
                phone: '',
                message: '',
                file: null,
            }
        }
    },
    mounted() {},
    methods: {
        async submit() {

            const isValidate = await this.$validator.validateAll();

            if (!isValidate) return;

            const formData = new FormData();
            formData.append('name', this.contact.name);
            formData.append('email', this.contact.email);
            formData.append('phone', this.contact.phone);
            formData.append('message', this.contact.message);
            formData.append('file', this.contact.file);

            try {
                await axios.post(this.url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                this.$toast.success('Sua mensagem foi enviada com sucesso!', {
                    duration: 2000,
                    pauseOnHover: false
                });
                this.$toast.info('Redirecionando...',{
                    duration: 1100,
                    pauseOnHover: false
                });

                setTimeout(() => {
                    location.href = '/';
                }, 3200);

            } catch (error) {
                if (error.response) {
                    const errorObj = error.response.data.data.errors;
                    for (const error in errorObj) {
                        this.$toast.error(errorObj[error][0])
                    }
                } else if (error.request) {
                    console.error(error.request);
                } else {
                    console.error('Error', error.message);
                }
            }

        }
    }
}
</script>

<style scoped>

</style>
