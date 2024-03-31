import {Component, OnInit} from '@angular/core';
import {OrderService} from "../../../services/orders/order.service";
import {ItemService} from "../../../services/items/item.service";
import {Order, VisualizableOrder} from "../../../models/orders";
import {Item} from "../../../models/item";

@Component({
  selector: 'app-orders',
  templateUrl: './orders.component.html',
  styleUrl: './orders.component.scss'
})
export class OrdersComponent implements OnInit {

  userId: number = 0;
  orders: Order[] = [];
  visualizableOrders: VisualizableOrder[] = [];

  constructor(private orderService: OrderService, private itemService: ItemService) {}

  ngOnInit(): void {
    this.userId = Number(window.localStorage.getItem('id'));
    this.getAllOrders();
  }

  getAllOrders() {
    this.orderService.getOrdersByUserId(this.userId).subscribe(response => {
      this.orders = response.orders;

      for (let order of this.orders) {
        order.isOpen = false;
        order.deliveryDate = new Date(order.creationDate);
        order.deliveryDate.setDate(order.deliveryDate.getDate() + 2);

        let currentDate = new Date();
        if(order.deliveryDate < currentDate) {
          order.delivered = true;
        } else {
          order.delivered = false;
        }

        // Options to format the date
        const options: Intl.DateTimeFormatOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        order.deliveryDateString= order.deliveryDate.toLocaleDateString('it-IT', options);

        this.orderService.getOrderItemsByOrderId(order.id).subscribe(response => {
          let items: Item[] = [];
          for (let orderItem of response.orderItems) {
            this.itemService.getItemById(orderItem.fkiditem).subscribe(response => {
              response.item.quantity = orderItem.quantity;
              items.push(response.item);
            });
          }

          let visualizableOrder: VisualizableOrder = {
            order: order,
            items: items
          }
          this.visualizableOrders.push(visualizableOrder);
        })
      }

      console.log(this.visualizableOrders)
    });
  }
}
