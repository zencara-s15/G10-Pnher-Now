import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';
import { ref } from 'vue';

export const usePostBaggageStore = defineStore('postBaggage', {
  state: () => ({
    post_baggage: [],
    user_baggage: ref(),
    baggage: ref<Object>(),
    responseMessage: ref<any>()
  }),
  actions: {
    async fetchPostBaggage() {
      try {
        const response = await axiosInstance.get('/baggage_list')
        this.post_baggage = response.data.data;
        // console.log(response.data.data)
        // this.post_baggage.map((baggage) => {
        //   this.user_baggage.push(baggage.post_id)
        // })
        this.user_baggage = this.post_baggage.map((baggage) => baggage.post_id);

        
        console.log(this.user_baggage);
      
        
      } catch (error) {
        console.error('Error fetching post baggage:', error);
      }
    },
    async addPostBaggage(newItem: { receiver_phone: string; sending_address: string; receiving_address: string; type: string; weight: string; company: string; post_id: number; delivery_status_id: number; }) {
      try {
        const response = await axiosInstance.post('/baggage_post', newItem);
        this.post_baggage.push(response.data); // Assuming response.data is the newly added item
      } catch (error) {
        console.error('Error adding post baggage:', error);
        throw error; // Throw the error to handle it in the component
      }
    },
    async deletePostBaggage(itemId: number) {
      try {
        await axiosInstance.delete(`/baggage_delete/${itemId}`);
        this.post_baggage = this.post_baggage.filter(item => item.id !== itemId);
      } catch (error) {
        console.error('Error deleting post baggage:', error);
        throw error; // Throw the error to handle it in the component
      }
    },
    async updateBaggageStatus(id: number, baggage_id: number) {
      try {
        const response = await axiosInstance.put(`/baggage_update/${baggage_id}`, {delivery_status_id: id});
        this.responseMessage = response;

      } catch (error) {
        console.error('Error updating baggage status:', error);
        throw error; // Throw the error to handle it in the component
      }
    }
    
  },
});
