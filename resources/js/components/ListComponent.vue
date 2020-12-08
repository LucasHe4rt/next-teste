<template>
    <div>
        <b-table
            striped
            :items="items"
            :busy="isBusy"
        >
            <template #cell(ações)="data">
                <b-row>
                    <b-col md="6">
                        <b-button @click="view(data.item['#'])" variant="primary">Ler</b-button>
                    </b-col>
                    <b-col md="6">
                        <b-button @click="remove(data.item['#'])" variant="danger">Deletar</b-button>
                    </b-col>
                </b-row>
            </template>
            <template #table-busy>
                <b-skeleton-table
                    :columns="5"
                    :table-props="{ striped: true }"
                ></b-skeleton-table>
            </template>
        </b-table>

        <b-modal scrollable id="view-modal" hide-footer :title="`Exibindo mensagem de ${contact.name}`">
            <p class="my-4">
                {{ contact.message }}
            </p>
        </b-modal>

    </div>
</template>

<script>
export default {
    props: {
        url: String
    },
    async mounted() {
        const contactLogsResponse = await axios.get(this.url);
        this.items = contactLogsResponse.data.data.contact_logs.map(contactLog => {
            return {
                '#': contactLog.id,
                nome: contactLog.name,
                email: contactLog.email,
                telefone: contactLog.phone,
                ações: ''
            }
        });
        this.isBusy = false;
    },
    data() {
        return {
            isBusy: true,
            items: [],
            contact: {
                name: null,
                email: null,
                phone: null,
                message: null,
                file_path: null
            }
        }
    },
    methods: {
        async remove(id) {
            await axios.delete(`/${id}`);
            this.$toast.success('Informacão deletada com sucesso! Atualizando...');
            setTimeout(() => location.reload(), 3100);
        },
        async view(id) {
            const viewResponse = await axios.get(`/${id}`);
            this.contact = viewResponse.data.data.contact_log
            this.$bvModal.show('view-modal');
        }
    }
}
</script>

<style scoped>

</style>
