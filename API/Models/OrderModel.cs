using System.ComponentModel.DataAnnotations;

namespace API.Models
{
    public class OrderModel
    {
        public int? id { get; set; }

        public string? name { get; set; }
        public string? email { get; set; }
        public string? phone { get; set; }
        public int? qty { get; set; }

        public int? event_id { get; set; }
    }
}

