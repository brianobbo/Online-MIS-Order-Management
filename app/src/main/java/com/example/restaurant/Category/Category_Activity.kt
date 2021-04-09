
package com.example.restaurant.Category

import android.content.Context
import android.content.Intent
import android.os.Bundle
import android.view.*
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.GridLayoutManager
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.JsonArrayRequest
import com.android.volley.toolbox.Volley
import com.example.restaurant.Cart_Activity
import com.example.restaurant.Items.ItemAdapter
import com.example.restaurant.Items.Item_Activity
import com.example.restaurant.Items.Items
import com.example.restaurant.R
import com.example.restaurant.UserInfo
import kotlinx.android.synthetic.main.activity_category.*
import kotlinx.android.synthetic.main.ticket.view.*

class Category_Activity : AppCompatActivity() {

    var adapter:catAdapter? = null
    var listofCats = ArrayList<CatTicket>()



    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_category)


        ////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////Inflate recycler View////////////////////////////////////////////////////////////////////////
        var url = UserInfo.baseUrl +"get_all_items.php"

        var list = ArrayList<Items>()

        var rq: RequestQueue = Volley.newRequestQueue(this)
        var jar = JsonArrayRequest(Request.Method.GET,url,null,Response.Listener{ response ->

            for (x in 0..response.length()-1)

                list.add(
                    Items(
                        response.getJSONObject(x).getInt("id"),
                        response.getJSONObject(x).getString("name"),
                        response.getJSONObject(x).getDouble("price"),
                        response.getJSONObject(x).getString("photo")
                    )
                )

            var ad = ItemAdapter(this, list)
            rvAllItems.layoutManager = GridLayoutManager(this,2)
            rvAllItems.adapter = ad

        },Response.ErrorListener { error ->
            Toast.makeText(this,error.message,Toast.LENGTH_LONG).show()
        })
        rq.add(jar)
        ///////////////////////////////////////////////////////////////////////////////////////////////////////



        listofCats.add(CatTicket("snacks",R.drawable.pizza_icon))
        listofCats.add(CatTicket("deserts",R.drawable.sandwich))
        listofCats.add(CatTicket("drinks",R.drawable.soda))
        listofCats.add(CatTicket("fruits",R.drawable.fastfood))
        listofCats.add(CatTicket("vegetables",R.drawable.logo))
        listofCats.add(CatTicket("local_food",R.drawable.katogo))


        adapter = catAdapter(this, listofCats)
        gridView.adapter = adapter

    }

    ///Cartview on appbar _>on click intents to cart activity
    override fun onCreateOptionsMenu(menu: Menu?): Boolean {
        menuInflater.inflate(R.menu.view_cart,menu)
        return super.onCreateOptionsMenu(menu)
    }
    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        if (item.itemId == R.id.viewCart) {
            var I = Intent(this, Cart_Activity::class.java)
            startActivity(I)
        }
        return  super.onOptionsItemSelected(item)
    }



    //base adapter ->customadapter
    class catAdapter: BaseAdapter{
        var listofCat = ArrayList<CatTicket>()
        var context: Context? = null

        constructor(context: Context, listofCat:ArrayList<CatTicket>){
            this.context=context
            this.listofCat=listofCat
        }

        override fun getView(position: Int, convertView: View?, parent: ViewGroup?): View {
            val  cat = this.listofCat[position]

            //inflate the ticket layout
            val inflator = context!!.getSystemService(Context.LAYOUT_INFLATER_SERVICE) as LayoutInflater
            var catView = inflator.inflate(R.layout.ticket, null)

            catView.ivCatImage.setImageResource(cat.catImage!!)
            catView.tvCatName.text = cat.catName

            //making catImage intent to item activity on click
            catView.ivCatImage.setOnClickListener {
                val intent = Intent(context, Item_Activity::class.java)
                //create intent data -> catName to be receiveed in ItemActivity
                intent.putExtra("catName", cat.catName)
                context!!.startActivity(intent)
            }
            return catView
        }

        override fun getItem(position: Int): Any {
            return listofCat[position]
        }

        override fun getItemId(position: Int): Long {
            return position.toLong()
        }

        override fun getCount(): Int {
            return listofCat.size
        }
    }



    //when press back intent to the same category activity
    override fun onBackPressed() {
        var I = Intent(this, Category_Activity::class.java)
        startActivity(I)
    }

}
