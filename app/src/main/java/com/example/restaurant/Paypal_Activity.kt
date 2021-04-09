package com.example.restaurant

import android.app.Activity
import android.content.Intent
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley
import com.example.restaurant.Category.Category_Activity
import com.paypal.android.sdk.payments.PayPalConfiguration
import com.paypal.android.sdk.payments.PayPalPayment
import com.paypal.android.sdk.payments.PayPalService
import com.paypal.android.sdk.payments.PaymentActivity
import kotlinx.android.synthetic.main.activity_cartview.*
import kotlinx.android.synthetic.main.activity_paypal_.*
import java.math.BigDecimal

class Paypal_Activity : AppCompatActivity() {

    var config: PayPalConfiguration? = null
    var amount:Double= 0.0

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_paypal_)


        //get total and insert to text

        var total:String? = null
        var url = UserInfo.baseUrl +"get_total.php?bill_no=" +intent.getStringExtra("bno")
        var rq: RequestQueue = Volley.newRequestQueue(this)
        var sr = StringRequest(Request.Method.GET,url, Response.Listener { response ->

            total = response
            tv_total.text = "Total Ugx." +total

        }, Response.ErrorListener { error ->
            Toast.makeText(this,error.message, Toast.LENGTH_SHORT).show()
        })
        rq.add(sr)


        //paypal config
        //PaypalConfiguration

        config = PayPalConfiguration().environment(PayPalConfiguration.ENVIRONMENT_SANDBOX).clientId(UserInfo.client_id)
        var i = Intent(this, PayPalService::class.java)
        i.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION,config)
        startService(i)

        buPay.setOnClickListener {
            amount = total.toString().toDouble()
            var payment = PayPalPayment(BigDecimal.valueOf(amount),"USD","Restaurant", PayPalPayment.PAYMENT_INTENT_SALE)
            var intent = Intent(this, PaymentActivity::class.java)
            intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION,config)
            intent.putExtra(PaymentActivity.EXTRA_PAYMENT,payment)

            //If user accepts Paymet(clicks ok)
            startActivityForResult(intent,123)
        }
    }


    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (requestCode==123){
            if (resultCode== Activity.RESULT_OK){
                var intent = Intent(this, Category_Activity::class.java)
                Toast.makeText(this,"payment successful",Toast.LENGTH_LONG).show()
                startActivity(intent)
                finish()
            }
        }
    }

   // Stopping the   paypal service..after leaving the activity
   //This is because when left running ..it consumes data ..
    override fun onDestroy() {
        stopService(Intent(this,PayPalService::class.java))
        super.onDestroy()
    }
}


