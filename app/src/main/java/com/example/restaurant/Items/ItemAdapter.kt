package com.example.restaurant.Items

import android.app.Activity
import android.content.Context
import android.content.Intent
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.example.restaurant.QtyFragment
import com.example.restaurant.R
import com.example.restaurant.UserInfo
import com.squareup.picasso.Picasso
import kotlinx.android.synthetic.main.items_row.view.*

class ItemAdapter (var context: Context, var list: ArrayList<Items>): RecyclerView.Adapter<RecyclerView.ViewHolder>(){
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): RecyclerView.ViewHolder {
        var v: View = LayoutInflater.from(context).inflate(R.layout.items_row,parent,false)
        return itemHolder(v)
    }

    override fun getItemCount(): Int {
       return list.size
    }


    override fun onBindViewHolder(holder: RecyclerView.ViewHolder, position: Int) {
        (holder as itemHolder).bind(list[position].name,list[position].price,list[position].photo,list[position].id)

    }

    class itemHolder(itemView: View): RecyclerView.ViewHolder(itemView){

        fun bind(n: String, p: Double, u: String,item_id: Int){
            itemView.tvItemName.text = n
            itemView.tvPrice.text = p.toString()




           //u -> name of the photo that will be concatinated with the url on ##on function onBindViewHolder u-> is gotten from list[position].photo
            var web: String = UserInfo.baseUrl +"images/"+u

            //this removes any space between the name of photo that would hinder it to be displayed
            web = web.replace(" ","@20")

            //load image to imageView
            //picasso.with(context) -> replaced with -> picasso.get()
            Picasso.get().load(web).into(itemView.imageView)

            //set image item_add_photo on click to show adapter to add qty
            itemView.addToCart.setOnClickListener {
                UserInfo.itemId =item_id



                var obj = QtyFragment()
                var manager = (itemView.context as Activity).fragmentManager
                obj.show(manager,"Qty")


            }

        }
    }
}
