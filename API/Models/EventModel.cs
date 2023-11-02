using System.ComponentModel.DataAnnotations;

namespace API.Models
{
    public class EventModel
    {
        public int id { get; set; }

        public string? title { get; set; }
        public string? cover_img { get; set; }
        public string? description { get; set; }
        public string? duration { get; set; }
        public DateTime end_date { get; set; }
        public DateTime date_showing { get; set; }
        public string? location { get; set; }
        public string? price { get; set; }

        public string? partner_id { get; set; }

    }
}


