function viewMessage(messageId,trElement) {
  var message = { messageId: messageId };

  $.ajax({
    type: "POST",
    url: "processing_data/get_message.php",
    data: message,
    success: function (res) {
      res = JSON.parse(res)[0];
      console.log(res);
      if (res) {
        var messageRef = document.getElementById("message");
        messageRef.innerHTML = "";
        messageRef.innerHTML = `                
        <form name="RegForm" action="">
           <h3>Message</h3>
           <input type="text" name="name" placeholder="Your Name" readonly
               value="`+ res.name+`">
           <input type="text" name="surname" placeholder="Your Surname" readonly
               value="`+ res.surname+`">
           <input type="text" name="email" placeholder="Email" readonly
               value="`+ res.email+`">
           <input type="text" name="subject" placeholder="subject" readonly
               value="`+ res.subject+`">
           <textarea name="message" id="" cols="30" rows="10" placeholder="Your message"
               readonly>Sent on: "`+ res.date+`"\n\n  `+ res.message+`</textarea>
       </form>`;
       trElement.style.backgroundColor = '#ffffff';
       setSeenTrue(messageId);
      } else {
        Swal.fire({
          title: "Connection error",
          text: "Try again later!",
          icon: "error",
        });
      }
    },
    error: function (err) {
      Swal.fire({
        title: "Connection error",
        text: "Try again later!",
        icon: "error",
      });
    },
  });
}

function setSeenTrue(messageId){
    var message = { messageId: messageId };

    $.ajax({
      type: "POST",
      url: "processing_data/set_seen_true.php",
      data: message,
      success: function (res) {
      }
    });
}