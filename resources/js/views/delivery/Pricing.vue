<template>
  <div class="app-container">
    <div v-if="!getIsSuccess">
      <el-row class="cities" type="flex" align="center" justify="center" :gutter="10">
        <el-col :span="6">
          <p>Маршрут</p>
        </el-col>
        <el-col :span="9">
          <div class="sub-title">Город-отправитель</div>
          <el-autocomplete
            v-model="v$.citySender.$model"
            class="inline-input"
            :fetch-suggestions="querySearch"
            placeholder="Введите название города"
            :value-key="'Description'"
            @select="handleCitySender"
          />
          <div v-if="v$.citySender.$errors[0]" class="sub-title error-msg">
            Обязательно для заполнения
          </div>
        </el-col>
        <el-col :span="9">
          <div class="sub-title">Город-получатель</div>
          <el-autocomplete
            v-model="v$.cityRecipient.$model"
            class="inline-input"
            :fetch-suggestions="querySearch"
            placeholder="Введите название города"
            :value-key="'Description'"
            @select="handleCityRecipient"
          />
          <div v-if="v$.cityRecipient.$errors[0]" class="sub-title error-msg">
            Обязательно для заполнения
          </div>
        </el-col>
      </el-row>
      <el-row class="service" type="flex" align="center" justify="center" :gutter="10">
        <el-col :span="6">
          <p>Тип услуги</p>
        </el-col>
        <el-col :span="18">
          <el-select v-model="priceForm.serviceType" placeholder="Тип услуги">
            <el-option
              v-for="service in getServiceTypes"
              :key="service.Ref"
              :label="service.Description"
              :value="service.Ref"
            />
          </el-select>
        </el-col>
      </el-row>
      <el-row class="type" type="flex" align="center" justify="center" :gutter="10">
        <el-col :span="6">
          <p>Тип отправления</p>
        </el-col>
        <el-col :span="18">
          <el-select v-model="priceForm.cargoType" placeholder="Тип отправления">
            <el-option
              v-for="cargo in getCargoTypes"
              :key="cargo.Ref"
              :label="cargo.Description"
              :value="cargo.Ref"
            />
          </el-select>
        </el-col>
      </el-row>
      <el-row
        v-if="priceForm.cargoType === 'Cargo'"
        class="info"
        type="flex"
        align="center"
        :gutter="20"
      >
        <el-col :span="6">
          <p>Данные о посылке</p>
        </el-col>
        <el-col :span="3">
          <div class="sub-title">Вес посылки в кг</div>
          <el-input-number
            v-model="priceForm.weight"
            controls-position="right"
            :min="1"
            :max="100"
          />
        </el-col>
        <el-col :span="3">
          <div class="sub-title">Количество мест</div>
          <el-input-number
            v-model="priceForm.seatsAmount"
            controls-position="right"
            :min="1"
            :max="2000"
          />
        </el-col>
        <el-col :span="3">
          <div class="sub-title">Ширина в см</div>
          <el-input-number
            v-model="priceForm.width"
            controls-position="right"
            :min="1"
            :max="2000"
          />
        </el-col>
        <el-col :span="3">
          <div class="sub-title">Высота в см</div>
          <el-input-number
            v-model="priceForm.height"
            controls-position="right"
            :min="1"
            :max="2000"
          />
        </el-col>
        <el-col :span="3">
          <div class="sub-title">Длина в см</div>
          <el-input-number
            v-model="priceForm.length"
            controls-position="right"
            :min="1"
            :max="100"
          />
        </el-col>
      </el-row>
      <el-row
        class="cost"
        type="flex"
        align="center"
        justify="space-between"
        :gutter="20"
      >
        <el-col :span="6">
          <p>Стоимость посылки</p>
        </el-col>
        <el-col :span="18">
          <el-input-number
            v-model="priceForm.cost"
            controls-position="right"
            :min="200"
            :max="100000"
          />
        </el-col>
      </el-row>
      <el-row class="submit-btn" type="flex" align="center" justify="center">
        <el-button type="danger" plain @click="submitForm">Рассчитать стоимость</el-button>
      </el-row>
    </div>
    <div v-if="getIsSuccess">
      <el-row type="flex" justify="center">
        <el-col>
          <p>Стоимость доставки для {{ getServiceByType[0].Description }} составляет {{ getResult[0].Cost }} грн</p>
        </el-col>
        <el-col>
          <el-button type="danger" plain @click="resetForm">Рассчитать стоимость</el-button>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';

export default {
  name: 'Pricing',
  setup() {
    return { v$: useVuelidate() };
  },

  data() {
    return {
      citySender: '',
      cityRecipient: '',
      priceForm: {
        citySender: '',
        cityRecipient: '',
        serviceType: '',
        cargoType: '',
        weight: 1,
        seatsAmount: 1,
        cost: 300,
        length: 1,
        height: 1,
        width: 1,
      },
    };
  },

  computed: {
    getServiceTypes() {
      return this.$store.getters['service/getServiceTypes'];
    },

    getCargoTypes() {
      return this.$store.getters['cargo/getCargoTypes'];
    },

    getIsSuccess() {
      return this.$store.getters['document/getIsSuccess'];
    },

    getResult() {
      return this.$store.getters['document/getResult'];
    },

    getServiceByType() {
      return this.$store.getters['service/getServiceByType'](this.priceForm.serviceType);
    },
  },

  validations() {
    return {
      citySender: { required },
      cityRecipient: { required },
    };
  },

  mounted() {
    // eslint-disable-next-line no-undef
    this.$store.dispatch('city/fetchCities');
    this.$store.dispatch('service/fetchServiceTypes');
    this.$store.dispatch('cargo/fetchCargoTypes');
  },

  methods: {
    handleCitySender() {
      // eslint-disable-next-line no-sequences
      const citySender = this.$store.getters['city/getCityByString'](this.citySender);
      this.priceForm.citySender = citySender[0].Ref;
    },

    handleCityRecipient() {
      const cityRecipient = this.$store.getters['city/getCityByString'](this.cityRecipient);
      this.priceForm.cityRecipient = cityRecipient[0]?.Ref;
    },

    querySearch(query, cb) {
      if (query !== '') {
        this.$store.dispatch('city/fetchCity', query);
        const city = this.$store.getters['city/getCity'];
        const result = city.length > 1 ? city : [];
        cb(result);
      }
    },

    async submitForm() {
      const isFormCorrect = await this.v$.$validate();
      if (isFormCorrect) {
        console.log('Ok');
        await this.$store.dispatch('document/fetchDocumentPrice', this.priceForm);
      }
    },

    resetForm() {
      this.$store.commit('document/SET_IS_SUCCESS', false);
      this.priceForm = {
        citySender: '',
        cityRecipient: '',
        serviceType: '',
        cargoType: '',
        weight: 1,
        seatsAmount: 1,
        cost: 300,
        length: 1,
        height: 1,
        width: 1,
      };
      this.citySender = this.cityRecipient = '';
    },
  },
};
</script>

<style scoped>
.cities {
  margin-bottom: 20px;
}

.service {
  margin-bottom: 20px;
}

.info {
  margin-bottom: 20px;
}

.cost {
  margin-bottom: 20px;
}

.error-msg {
  font-size: 14px;
  color: #ea0202;
}
</style>
