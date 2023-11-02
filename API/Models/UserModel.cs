using System.ComponentModel.DataAnnotations;

namespace API.Models
{
    public class UserModel
    {
        [MaxLength(255)]
        public string? id { get; set; }

        public string? user_type { get; set; }
        public string? name { get; set; }
        public string? email { get; set; }
        public string? password { get; set; }
        public string? phone { get; set; }
    }
}
