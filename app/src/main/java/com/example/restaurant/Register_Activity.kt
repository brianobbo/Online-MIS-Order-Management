///
package com.example.restaurant

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
import kotlinx.android.synthetic.main.activity_register.*

class Register_Activity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_register)

        buSignUpRegister.setOnClickListener {

            //checking if pssd and C_pssd are the same
            if (etPassordRegister.text.toString() == etConfirmPassword.text.toString()) {
                var url = UserInfo.baseUrl +"add_users.php?mobile=" + etPhoneRegister.text.toString() +
                            "&password=" + etPassordRegister.text.toString() + "&name=" + etName.text.toString() + "&address=" + etAddress.text.toString()

                var rq: RequestQueue = Volley.newRequestQueue(this)
                var sr  = StringRequest(Request.Method.GET,url,Response.Listener { response ->

                    //checking if user mobile already exists in database is registered
                    if (response == ("0"))
                        Toast.makeText(this,"mobile already used ",Toast.LENGTH_LONG).show()

                    else {
                        UserInfo.mobile = buSignUpRegister.text.toString()
                        val intent = Intent(this, Category_Activity::class.java)
                        startActivity(intent)
                        finish()
                    }

                },Response.ErrorListener { error ->
                    Toast.makeText(this,error.message,Toast.LENGTH_LONG).show()
                })

                rq.add(sr)
            }else
                Toast.makeText(this,"Password not match",Toast.LENGTH_LONG).show()
        }
    }
}
