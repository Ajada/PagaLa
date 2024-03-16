<template>
  <div>
    <vue-good-table
      compactMode
      max-height="400px"
      styleClass="vgt-table striped bordered condensed"
      :columns="columns"
      :rows="rows"
      :search="onSearch"
      :pagination-options="{
        enabled: true,
        perPage: 5,
      }"
      :search-options="{
        enabled: true,
        skipDiacritics: true,
        searchFn: mySearchFn,
        placeholder: 'Pesquisar',
        externalQuery: searchQuery,
      }"
    />
  </div>
</template>

<script>
export default {
  name: "my-component",
  props: {
    rows: Array
  },
  data() {
    return {
      columns: [
        {
          label: "Funcionário",
          field: "name",
          tdClass: this.tdClassFunc,
          tooltip: "Nome do funcionário",
        },
        {
          label: "Item",
          field: "iten",
          tooltip: "Itens retirados",
        },
        {
          label: "Registro",
          field: "created",
          type: "date",
          dateInputFormat: "yyyy-MM-dd",
          dateOutputFormat: "d/MM/y",
          width: "100px",
          tooltip: "Data da retirada do iten",
        },
        {
          label: "Motivo",
          field: "reason",
          tooltip: "Motivo da retirada",
        },
      ]
    };
  },
  methods: {
    tdClassFunc(row) {
      return "green-class";
    },
  },
};
</script>

<style lang="scss">
@media screen and (max-width: 780px) {
  .green-class {
    color: #2c3e50 !important;
    font-weight: bold;
  }
}
</style>
